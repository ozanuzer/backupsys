<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Newsletter;

class NewsController extends Controller
{
    public function index(){   
        $data = array(
            'title' => 'Bülten',
        );
        return view('admin.news.index')->with($data);
    }

    public function ajaxget(Request $request){
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
     $totalRecords = Newsletter::select('count(*) as allcount')->count();
     $totalRecordswithFilter = Newsletter::select('count(*) as allcount')->where('subject', 'like', '%' .$searchValue . '%')->count();

     // Fetch records
     $records = Newsletter::orderBy($columnName,$columnSortOrder)
       ->where('newsletter.subject', 'like', '%' .$searchValue . '%')
       ->select('newsletter.*')
       ->skip($start)
       ->take($rowperpage)
       ->get();

     $data_arr = array();
     
     foreach($records as $record){
        if ($record->status == 1)
            $statusHtml = '<a href="/panel/news/active/'.$record->id.'" class="btn btn-icon btn-success dbtalbe_button"> <i class="mdi mdi-check-bold"></i> </a>';
        else
            $statusHtml = '<a href="/panel/news/active/'.$record->id.'" class="btn btn-icon btn-dark dbtalbe_button"> <i class="mdi mdi-check-bold"></i> </a>';
        $data_arr[] = array(
            "sort" => '<a href="/panel/news/up/'.$record->id.'" class="btn btn-icon btn-primary dbtalbe_button"> <i class="fas fa-angle-up"></i> </a>&nbsp;<a href="/panel/news/down/'.$record->id.'" class="btn btn-icon btn-primary dbtalbe_button"> <i class="fas fa-angle-down"></i> </a>',
            "title" => $record->subject,
            "created_at" => date('m/d/Y', strtotime($record->created_at)),
            "status" => $statusHtml,
            "actions" => '<div class="btn-group">
                            <a href="'.route('panel.news.edit', $record->id).'" type="button" class="btn btn-secondary dbtalbe_button">Düzenle</a>
                            <a href="'.route('panel.news.update', $record->id).'" type="button" class="btn btn-secondary dbtalbe_button">Sil</a>
                        </div>',
            "id" => $record->id
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

    public function create(){
        return view('admin.news.forms');
    }

    public function store(Request $request){
        $req = $request->all();
        $news = new Newsletter; 
        //print_r($models);
        //echo $req['name'];
        $news->subject = $req['subject'];
        $news->sort = 0;
        $news->status = 1;
        $news->save();
        $new = Newsletter::Find($news->id);
        return view('admin.news.forms')->with('news', $new);
        //return redirect()->route('panel.news');
    }

    public function edit($id){
        $news = Newsletter::Find($id);
        return view('admin.news.forms')->with('news', $news);
    }

    public function update($id, Request $request){
        $req = $request->all();
        $news = Newsletter::Find($id);
        //print_r($models);
        //echo $req['name'];
        $news->subject = $req['subject'];
        $news->update();
        return back()->withInput();
        //return redirect()->route('models.women');
    }

    public function delete($id){
        $news = Newsletter::Find($id);
        $news->delete();
        return back()->withInput();
        //return redirect()->route('models.poloraid', $id);
    }

    public function upmodel($id){
        $news = Newsletter::Find($id);
        if ($news->sort > 1){
            $temp = Newsletter::where('sort', ($news->sort-1))->first();
            $temp->sort = $news->sort;
            $news->sort = $news->sort - 1;
            $news->update();
            $temp->update();
        }
        return back()->withInput();
    }

    public function downmodel($id){
        $news = Newsletter::Find($id);
        $allmodel = count(Newsletter::get());
        if ($news->sort < $allmodel){
            $temp = Newsletter::where('sort', ($news->sort+1))->first();
            $temp->sort = $news->sort;
            $news->sort = $news->sort + 1;
            $news->update();
            $temp->update();
        }
        return back()->withInput();
    }

    public function activemodel($id){
        $news = Newsletter::Find($id);
        //print_r($models);
        //echo $req['name'];
        $news->status = ($news->status == 1) ? 0 : 1;
        $news->update();
        return back()->withInput();
        //return redirect()->route('models.gallery', $id);
    }

    public function resort(){
        $news = Newsletter::orderBy('sort','ASC')->get();
        $c = 1;
        foreach ($news as $new) {
            $modeltemp = Newsletter::Find($new->id);
            $modeltemp->sort = $c;
            $modeltemp->update();
            $c++;
        }
        return true;
    }

}
