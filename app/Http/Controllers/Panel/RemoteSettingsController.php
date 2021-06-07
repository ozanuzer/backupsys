<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RemoteSettings;

class RemoteSettingsController extends Controller
{
    public function index(){   
        $data = array(
            'title' => 'Remote Settings',
        );
        return view('admin.remotesettings.index')->with($data);
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
     $totalRecords = RemoteSettings::select('count(*) as allcount')->count();
     $totalRecordswithFilter = RemoteSettings::select('count(*) as allcount')->where('name', 'like', '%' .$searchValue . '%')->count();

     // Fetch records
     //$records = RemoteSettings::orderBy($columnName,$columnSortOrder)
     $records = RemoteSettings::orderBy('id',$columnSortOrder)
       ->where('remote_settings.name', 'like', '%' .$searchValue . '%')
       ->select('remote_settings.*')
       ->skip($start)
       ->take($rowperpage)
       ->get();

     $data_arr = array();
     
     foreach($records as $record){
        $data_arr[] = array(
            "sort" => $record->id,
            "name" => $record->name,
            "remotetype" => $record->remotetype,
            "actions" => '<div class="btn-group">
                            <a href="'.route('panel.remotesettings.edit', $record->id).'" type="button" class="btn btn-secondary dbtalbe_button">Edit</a>
                            <a href="'.route('panel.remotesettings.delete', $record->id).'" type="button" class="btn btn-secondary dbtalbe_button" onclick="return confirm(\'Do you confirm delete?\');" >Delete</a>
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
        return view('admin.remotesettings.forms');
    }

    public function store(Request $request){
        $req = $request->all();
        $savedb = new RemoteSettings; 
        //print_r($models);
        //echo $req['name'];
        $savedb->name = $req['name'];
        $savedb->remoteip = $req['remoteip'];
        $savedb->remotelogin = $req['remotelogin'];
        $savedb->remotepass = $req['remotepassword'];
        $savedb->remoteport = $req['remoteport'];
        $savedb->remotepath = $req['remotepath'];
        $savedb->remotetype = $req['remotetype'];
        $savedb->save();
        $new = RemoteSettings::Find($savedb->id);
        return view('admin.remotesettings.forms')->with('savedb', $savedb);
        //return redirect()->route('panel.hosting');
    }

    public function edit($id){
        $savedb = RemoteSettings::Find($id);
        return view('admin.remotesettings.forms')->with('savedb', $savedb);
    }

    public function update($id, Request $request){
        $req = $request->all();
        $savedb = RemoteSettings::Find($id);
        //print_r($models);
        //echo $req['name'];
        $savedb->name = $req['name'];
        $savedb->remoteip = $req['remoteip'];
        $savedb->remotelogin = $req['remotelogin'];
        $savedb->remotepass = $req['remotepassword'];
        $savedb->remoteport = $req['remoteport'];
        $savedb->remotepath = $req['remotepath'];
        $savedb->remotetype = $req['remotetype'];
        $savedb->update();
        return back()->withInput();
    }

    public function delete($id){
        $savedb = RemoteSettings::Find($id);
        $savedb->delete();
        return back()->withInput();
        //return redirect()->route('models.poloraid', $id);
    }

    public function up($id){
        $savedb = RemoteSettings::Find($id);
        if ($savedb->sort > 1){
            $temp = RemoteSettings::where('sort', ($savedb->sort-1))->first();
            $temp->sort = $savedb->sort;
            $savedb->sort = $savedb->sort - 1;
            $savedb->update();
            $temp->update();
        }
        return back()->withInput();
    }

    public function down($id){
        $savedb = RemoteSettings::Find($id);
        $allmodel = count(hostingletter::get());
        if ($savedb->sort < $allmodel){
            $temp = RemoteSettings::where('sort', ($savedb->sort+1))->first();
            $temp->sort = $savedb->sort;
            $savedb->sort = $savedb->sort + 1;
            $savedb->update();
            $temp->update();
        }
        return back()->withInput();
    }

    public function active($id){
        $savedb = RemoteSettings::Find($id);
        //print_r($models);
        //echo $req['name'];
        $savedb->status = ($savedb->status == 1) ? 0 : 1;
        $savedb->update();
        return back()->withInput();
        //return redirect()->route('models.gallery', $id);
    }

    public function resort(){
        $savedb = RemoteSettings::orderBy('sort','ASC')->get();
        $c = 1;
        foreach ($savedb as $new) {
            $modeltemp = RemoteSettings::Find($new->id);
            $modeltemp->sort = $c;
            $modeltemp->update();
            $c++;
        }
        return true;
    }

}
