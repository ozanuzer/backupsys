<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Newsletter;
use App\Models\Newsletter_gallery;
use ImageOptimizer;

class NewsgalleryController extends Controller
{
    public function index($id){
        $news = Newsletter::Find($id);
        $data = array(
            'title' => 'Bülten - Görseller - ' . $news->subject,
            'news' => $news
        );
        return view('admin.news.gallery.index')->with($data);
    }

    public function create($id){
        $news = Newsletter::Find($id);
        $data = array(
            'title' => 'Yeni Görsel - ' . $news->subject,
            'news' => $news
        );
        return view('admin.news.gallery.forms')->with($data);
    }

    public function store($id, Request $request){
        $req = $request->all();
        $gallery = new Newsletter_gallery; 
        $imageName = time().'.'.$request->image->extension();  
     
        $request->image->move(public_path('images/news/'), $imageName);
        if ($_FILES["image"]["size"] > 250000)
            ImageOptimizer::optimize(public_path('images/news/').$imageName, public_path('images/news/optimize/').$imageName);
        else 
            File::copy(public_path('images/news/').$imageName, public_path('images/news/optimize/').$imageName);   
        //print_r($models);
        //echo $req['name'];
        $gallery->path = $imageName;
        $gallery->newsletter_id = $req['id'];
        $gallery->is_main = 0;
        $gallery->sort = 0;
        $gallery->status = 1;
        $gallery->save();
        return redirect()->route('panel.news.gallery', $req['id']);
    }

    public function ajaxget($id, Request $request){
        ## Read value
     $draw = $request->input('draw');
     $start = $request->input("start");
     $rowperpage = $request->input("length"); // Rows display per page

     $columnIndex_arr = $request->input('order');
     $columnName_arr = $request->input('columns');
     $order_arr = $request->input('order');
     $search_arr = $request->input('search');

     $columnIndex = $columnIndex_arr[0]['column']; // Column index
     $columnName = $columnName_arr[$columnIndex]['data']; // Column name
     $columnSortOrder = $order_arr[0]['dir']; // asc or desc
     $searchValue = $search_arr['value']; // Search value

     // Total records
     $totalRecords = Newsletter_gallery::select('count(*) as allcount')->where('newsletter_id', $id)->count();
     $totalRecordswithFilter = Newsletter_gallery::select('count(*) as allcount')->where('newsletter_id', $id)->count();

     // Fetch records
     $records = Newsletter_gallery::orderBy($columnName,$columnSortOrder)
       ->where('newsletter_id', $id)
       ->select('newsletter_gallery.*')
       ->skip($start)
       ->take($rowperpage)
       ->get();

     $data_arr = array();
     
     foreach($records as $record){
         if ($record->is_main == 1) $bg = 'style="background-color: #4fc55b;"'; else $bg = '';
        $data_arr[] = array(
            "sort" => $record->sort,
            "image" => '<img src="/images/news/optimize/'.$record->path.'" style="width:100%;">',
            "status" => '<a class="btn btn-icon btn-success dbtalbe_button"> <i class="mdi mdi-check-bold"></i> </a>',
            "actions" => '<div class="btn-group">
                            <a href="'.route('panel.news.gallery.makemain', [ 'id' => $id, 'gid' => $record->id]).'" type="button" class="btn btn-secondary dbtalbe_button" '.$bg.'>Ana İmaj</a>
                            <a href="'.route('panel.news.gallery.delete', [ 'id' => $id, 'gid' => $record->id]).'" type="button" class="btn btn-secondary dbtalbe_button">Sil</a>
                        </div>',
            "images" => '',
            "id" => $id
        );
     }

     $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecords,
        "iTotalDisplayRecords" => $totalRecordswithFilter,
        "aaData" => $data_arr
     );

     echo json_encode($response);
     exit;
    }

    public function makemain($id, $gid){
        $gallery = Newsletter_gallery::Find($gid);
        //print_r($models);
        //echo $req['name'];
        $gallery->is_main = ($gallery->is_main == 1) ? 0 : 1;
        $gallery->update();
        return redirect()->route('panel.news.gallery', $id);
    }

    public function delete($id, $gid){
        $gallery = Newsletter_gallery::Find($gid);
        $gallery->delete();
        return redirect()->route('panel.news.gallery', $id);
    }
}
