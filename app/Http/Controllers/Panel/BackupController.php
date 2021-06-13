<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hosting;
use App\Models\DatabaseUsers;
use App\Models\Log;
use App\Models\RemoteSettings;
use App\Models\Schedule;

class BackupController extends Controller
{
    public $periods = array(0 => 'Daily', 1 => 'Weekly', 2 => 'Monthly');
    public $backupItems = array(0 => 'Files', 1 => 'Databases', 2 => 'Files And Databases');
    public function index($id){
        $hosting = Hosting::Find($id);
        $databases = DatabaseUsers::where('hid', $id)->get();
        $logs = Log::where('hid', $id)->get();
        $remotesettings = RemoteSettings::all();
        $schedule = Schedule::where('hid', $id)->get();

        $i = 0;
        foreach($schedule as $item){
            $remote = RemoteSettings::Find($item->remoteId);
            $schedule[$i]->remoteName = $remote->name;
            $schedule[$i]->periodName = $this->periods[$item->period];
            $schedule[$i]->backupItemsName = $this->backupItems[$item->backupItems];
            $i++;
        }
        
        $data = array(
            'title' => 'Backups',
            'hosting' => $hosting,
            'logs' => $logs,
            'remotesettings' => $remotesettings,
            'schedule' => $schedule,
            'databases' => $databases
        );
        return view('admin.backups.index')->with($data);
    }

    public function storeDB($hid, Request $request){
        $req = $request->all();
        $savedb = new DatabaseUsers;
        $savedb->hid = $hid;
        $savedb->username = "no"; //$req['dbusername'];
        $savedb->password = "no"; //$req['dbpass'];
        $savedb->dbname = $req['dbname'];
        $savedb->save();
        $databases = DatabaseUsers::where('hid', $hid)->get();
        return response()->json([
            'success' => 'true',
            'databases' => $databases
        ]);
    }

    public function deleteDB($id, Request $request){
        $savedb = DatabaseUsers::Find($id);
        $savedb->delete();
        $req = $request->all();
        $databases = DatabaseUsers::where('hid', $req['hid'])->get();
        return response()->json([
            'success' => 'true',
            'databases' => $databases
        ]);
        //return back()->withInput();
        //return redirect()->route('models.poloraid', $id);
    }

    public function storeSCH($hid, Request $request){
        $req = $request->all();
        $savedb = new Schedule;
        $savedb->hid = $hid;
        $savedb->period = $req['period'];
        $savedb->remoteId = $req['remoteid'];
        if ($req['formfiles'] == 'true' && $req['formdatabases'] == 'true')
            $savedb->backupItems = 2;
        else if ($req['formfiles'] == 'true')
            $savedb->backupItems = 0;
        else if ($req['formdatabases'] == 'true')
            $savedb->backupItems = 1;
        $savedb->save();
        $schedule = Schedule::where('hid', $hid)->get();
        $i = 0;
        foreach($schedule as $item){
            $remote = RemoteSettings::Find($item->remoteId);
            $schedule[$i]->remoteName = $remote->name;
            $schedule[$i]->periodName = $this->periods[$item->period];
            $schedule[$i]->backupItemsName = $this->backupItems[$item->backupItems];
            $i++;
        }
        return response()->json([
            'success' => 'true',
            'schedule' => $schedule
        ]);
    }

    public function deleteSCH($id, Request $request){
        $savedb = Schedule::Find($id);
        $savedb->delete();
        $req = $request->all();
        $schedule = Schedule::where('hid', $req['hid'])->get();
        $i = 0;
        foreach($schedule as $item){
            $remote = RemoteSettings::Find($item->remoteId);
            $schedule[$i]->remoteName = $remote->name;
            $schedule[$i]->periodName = $this->periods[$item->period];
            $schedule[$i]->backupItemsName = $this->backupItems[$item->backupItems];
            $i++;
        }
        return response()->json([
            'success' => 'true',
            'schedule' => $schedule
        ]);
        //return back()->withInput();
        //return redirect()->route('models.poloraid', $id);
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
     $totalRecords = Hosting::select('count(*) as allcount')->count();
     $totalRecordswithFilter = Hosting::select('count(*) as allcount')->where('name', 'like', '%' .$searchValue . '%')->count();

     // Fetch records
     //$records = Hosting::orderBy($columnName,$columnSortOrder)
     $records = Hosting::orderBy('id',$columnSortOrder)
       ->where('hosting.name', 'like', '%' .$searchValue . '%')
       ->select('hosting.*')
       ->skip($start)
       ->take($rowperpage)
       ->get();

     $data_arr = array();
     
     foreach($records as $record){
        if ($record->status == 1)
            $statusHtml = '<a href="/panel/hosting/active/'.$record->id.'" class="btn btn-icon btn-success dbtalbe_button"> <i class="mdi mdi-check-bold"></i> </a>';
        else
            $statusHtml = '<a href="/panel/hosting/active/'.$record->id.'" class="btn btn-icon btn-dark dbtalbe_button"> <i class="mdi mdi-check-bold"></i> </a>';
        $data_arr[] = array(
            "sort" => $record->id,
            "name" => $record->name,
            "status" => $statusHtml,
            "actions" => '<div class="btn-group">
                            <a href="'.route('panel.hosting.edit', $record->id).'" type="button" class="btn btn-secondary dbtalbe_button">Edit</a>
                            <a href="'.route('panel.hosting.update', $record->id).'" type="button" class="btn btn-secondary dbtalbe_button">Backups</a>
                            <a href="'.route('panel.hosting.delete', $record->id).'" type="button" class="btn btn-secondary dbtalbe_button" onclick="return confirm(\'Do you confirm delete?\');" >Delete</a>
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
        return view('admin.hosting.forms');
    }

    public function store(Request $request){
        $req = $request->all();
        $hosting = new Hosting; 
        //print_r($models);
        //echo $req['name'];
        $hosting->name = $req['name'];
        $hosting->path = $req['path'];
        $hosting->dbpath = $req['dbpath'];
        $hosting->status = 1;
        $hosting->save();
        $new = Hosting::Find($hosting->id);
        return view('admin.hosting.forms')->with('hosting', $hosting);
        //return redirect()->route('panel.hosting');
    }

    public function edit($id){
        $hosting = Hosting::Find($id);
        return view('admin.hosting.forms')->with('hosting', $hosting);
    }

    public function update($id, Request $request){
        $req = $request->all();
        $hosting = Hosting::Find($id);
        //print_r($models);
        //echo $req['name'];
        $hosting->name = $req['name'];
        $hosting->update();
        return back()->withInput();
    }

    public function delete($id){
        $hosting = Hosting::Find($id);
        $hosting->delete();
        return back()->withInput();
        //return redirect()->route('models.poloraid', $id);
    }

    public function up($id){
        $hosting = Hosting::Find($id);
        if ($hosting->sort > 1){
            $temp = Hosting::where('sort', ($hosting->sort-1))->first();
            $temp->sort = $hosting->sort;
            $hosting->sort = $hosting->sort - 1;
            $hosting->update();
            $temp->update();
        }
        return back()->withInput();
    }

    public function down($id){
        $hosting = Hosting::Find($id);
        $allmodel = count(hostingletter::get());
        if ($hosting->sort < $allmodel){
            $temp = Hosting::where('sort', ($hosting->sort+1))->first();
            $temp->sort = $hosting->sort;
            $hosting->sort = $hosting->sort + 1;
            $hosting->update();
            $temp->update();
        }
        return back()->withInput();
    }

    public function active($id){
        $hosting = Hosting::Find($id);
        //print_r($models);
        //echo $req['name'];
        $hosting->status = ($hosting->status == 1) ? 0 : 1;
        $hosting->update();
        return back()->withInput();
        //return redirect()->route('models.gallery', $id);
    }

    public function resort(){
        $hosting = Hosting::orderBy('sort','ASC')->get();
        $c = 1;
        foreach ($hosting as $new) {
            $modeltemp = Hosting::Find($new->id);
            $modeltemp->sort = $c;
            $modeltemp->update();
            $c++;
        }
        return true;
    }

}
