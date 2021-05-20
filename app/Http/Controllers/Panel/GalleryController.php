<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Modeldb;
use App\Models\Gallery;
use ImageOptimizer;
use File;

class GalleryController extends Controller
{
    public function index($id){
        $model = Modeldb::Find($id);
        $data = array(
            'title' => 'Modeller',
            'model' => $model
        );
        return view('admin.models.gallery.index')->with($data);
    }

    public function creategallery($id){
        $model = Modeldb::Find($id);
        $data = array(
            'title' => 'Modeller',
            'imagetype' => 'image',
            'model' => $model
        );
        return view('admin.models.gallery.forms')->with($data);
    }

    public function storegallery($id, Request $request){
        $req = $request->all();
        $gallery = new Gallery; 
        $imageName = time().'.'.$request->image->extension();  
     
        $request->image->move(public_path('images/models/'), $imageName);
        if ($_FILES["image"]["size"] > 250000)
            ImageOptimizer::optimize(public_path('images/models/').$imageName, public_path('images/models/optimize/').$imageName);
        else 
            File::copy(public_path('images/models/').$imageName, public_path('images/models/optimize/').$imageName);   
        //print_r($models);
        //echo $req['name'];
        $gallery->path = $imageName;
        $gallery->imagetype = $req['imagetype'];
        $gallery->model_id = $req['id'];
        $gallery->is_main = 0;
        $gallery->sort = 0;
        $gallery->save();
        return redirect()->route('models.gallery', $req['id']);
    }

    public function ajaxgallery($id, Request $request){
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
     $totalRecords = Gallery::select('count(*) as allcount')->where('model_id', $id)->where('imagetype', 'image')->count();
     $totalRecordswithFilter = Gallery::select('count(*) as allcount')->where('model_id', $id)->where('imagetype', 'image')->count();

     // Fetch records
     $records = Gallery::orderBy($columnName,$columnSortOrder)
       ->where('model_id', $id)
       ->where('imagetype', 'image')
       ->select('gallery.*')
       ->skip($start)
       ->take($rowperpage)
       ->get();

     $data_arr = array();
     
     foreach($records as $record){
         if ($record->is_main == 1) $bg = 'style="background-color: #4fc55b;"'; else $bg = '';
        $data_arr[] = array(
            "sort" => $record->sort,
            "image" => '<img src="/images/models/optimize/'.$record->path.'" style="width:100%;">',
            "status" => '<a class="btn btn-icon btn-success dbtalbe_button"> <i class="mdi mdi-check-bold"></i> </a>',
            "actions" => '<div class="btn-group">
                            <a href="'.route('models.gallery.makemain', [ 'id' => $id, 'gid' => $record->id]).'" type="button" class="btn btn-secondary dbtalbe_button" '.$bg.'>Ana İmaj</a>
                            <a href="'.route('models.gallery.delete', [ 'id' => $id, 'gid' => $record->id]).'" type="button" class="btn btn-secondary dbtalbe_button">Sil</a>
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

    public function makemaingallery($id, $gid){
        $gallery = Gallery::Find($gid);
        //print_r($models);
        //echo $req['name'];
        $gallery->is_main = ($gallery->is_main == 1) ? 0 : 1;
        $gallery->update();
        return redirect()->route('models.gallery', $id);
    }

    public function deletegallery($id, $gid){
        $gallery = Gallery::Find($gid);
        $gallery->delete();
        return redirect()->route('models.gallery', $id);
    }
}
