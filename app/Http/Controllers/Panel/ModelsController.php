<?php

namespace App\Http\Controllers\Panel;
use App\Models\Modeldb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;

class ModelsController extends Controller
{
    public function women(){
        $data = array(
            'title' => 'Modeller - Kadın',
            'type' => '2',
            'sortPrefix' => 'sort'
        );
        return view('admin.models.index')->with($data);
    }
    public function man(){
        $data = array(
            'title' => 'Modeller - Erkek',
            'type' => '1',
            'sortPrefix' => 'sort'
        );
        return view('admin.models.index')->with($data);
    }
    public function intown(){
        $data = array(
            'title' => 'Modeller - Şehirdekiler',
            'type' => '3',
            'sortPrefix' => 'sort_intown'
        );
        return view('admin.models.index')->with($data);
    }
    public function timeless(){
        $data = array(
            'title' => 'Modeller - Timeless',
            'type' => '4',
            'sortPrefix' => 'sort_timeless'
        );
        return view('admin.models.index')->with($data);
    }

    public function createmodel($type){
        if($type == 1) $type = 'panel.models.man'; else if($type == 2) $type = 'panel.models.women'; else if($type == 3) $type = 'panel.models.intown';
        else $type = 'panel.models.timeless';
        $data = array(
            'page' => 'Modeller - Şehirdekiler',
            'type' => $type
        );
        return view('admin.models.forms')->with($data);
    }

    public function storemodel(Request $request){
        $req = $request->all();
        $models = new Modeldb; 
        //print_r($models);
        //echo $req['name'];
        $models->name = $req['name'];
        $models->surname = $req['surname'];
        $models->birth_year = $req['birth_year'];
        $models->height = $req['height'];
        $models->body_size = $req['body_size'];
        $models->size = $req['size'];
        $models->shoes = $req['shoes'];
        $models->hair = $req['hair'];
        $models->hair_tr = $req['hair_tr'];
        $models->eyes = $req['eyes'];
        $models->eyes_tr = $req['eyes_tr'];
        $models->gender = $req['gender'];
        $models->type = $req['intown'];
        $models->timeless = $req['timeless'];
        $models->sort = 0;
        $models->sort_intown = 0;
        $models->sort_timeless = 0;
        $models->arrival = date('Y-m-d', strtotime($req['arrival']));
        $models->departure = date('Y-m-d', strtotime($req['departure']));
        $models->video_url = $req['video_url'];
        $models->instagram = $req['instagram'];
        $models->status = 1;
        $models->save();

        if ($models->type == 1){
            $this->resortintown();
        } else if ($models->timeless == 1) {
            $this->resorttimeless();
        } else {
            $this->resort();
        }

        return redirect()->route('panel.models.edit', ['id' => $models->id, 'type' => $models->type]);
    }

    public function getwomen($type, Request $request){
        if ($type == 1){
            $where = 'gender';
            $val = 1;
            $where2 = 'timeless';
            $val2 = 0;
            $sortPrefix = 'sort';
        } else if ($type == 2){
            $where = 'gender';
            $val = 2;
            $where2 = 'timeless';
            $val2 = 0;
            $sortPrefix = 'sort';
        } else if ($type == 3){
            $where = 'type';
            $val = 1;
            $where2 = 'timeless';
            $val2 = 0;
            $sortPrefix = 'sort_intown';
        } else if ($type == 4){
            $where = 'timeless';
            $val = 1;
            $where2 = 'timeless';
            $val2 = 1;
            $sortPrefix = 'sort_timeless';
        }

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
     $totalRecords = Modeldb::select('count(*) as allcount')->where($where, $val)->where($where2, $val2)->count();
     $totalRecordswithFilter = Modeldb::select('count(*) as allcount')->where($where, $val)->where($where2, $val2)->
     where('name', 'like', '%' .$searchValue . '%')->count();

     // Fetch records
     $records = Modeldb::orderBy($columnName,$columnSortOrder)
       ->where('models.name', 'like', '%' .$searchValue . '%')
       ->where($where, $val)
       ->where($where2, $val2)
       ->select('models.*')
       ->skip($start)
       ->take($rowperpage)
       ->get();

     $data_arr = array();
     
     foreach($records as $record){
        if ($type == 1 || $type == 2){
            $sortHtml = '<a href="/panel/models/up/'.$record->id.'" class="btn btn-icon btn-primary dbtalbe_button"> <i class="fas fa-angle-up"></i> </a>&nbsp;<a href="/panel/models/down/'.$record->id.'" class="btn btn-icon btn-primary dbtalbe_button"> <i class="fas fa-angle-down"></i> </a>';
        } else if ($type == 3){
            $sortHtml = '<a href="/panel/models/inup/'.$record->id.'" class="btn btn-icon btn-primary dbtalbe_button"> <i class="fas fa-angle-up"></i> </a>&nbsp;<a href="/panel/models/indown/'.$record->id.'" class="btn btn-icon btn-primary dbtalbe_button"> <i class="fas fa-angle-down"></i> </a>';
        } else if ($type == 4){
            $sortHtml = '<a href="/panel/models/tmup/'.$record->id.'" class="btn btn-icon btn-primary dbtalbe_button"> <i class="fas fa-angle-up"></i> </a>&nbsp;<a href="/panel/models/tmdown/'.$record->id.'" class="btn btn-icon btn-primary dbtalbe_button"> <i class="fas fa-angle-down"></i> </a>';
        }
        if ($record->status == 1)
            $statusHtml = '<a href="/panel/models/active/'.$record->id.'" class="btn btn-icon btn-success dbtalbe_button"> <i class="mdi mdi-check-bold"></i> </a>';
        else
            $statusHtml = '<a href="/panel/models/active/'.$record->id.'" class="btn btn-icon btn-dark dbtalbe_button"> <i class="mdi mdi-check-bold"></i> </a>';
        $data_arr[] = array(
            $sortPrefix => $sortHtml,
            "name" => $record->name,
            "surname" => $record->surname,
            "height" => $record->height,
            "body_size" => $record->body_size,
            "size" => $record->size,
            "shoes" => $record->shoes,
            "hair_tr" => $record->hair_tr,
            "eyes_tr" => $record->eyes_tr,
            "status" => $statusHtml,
            "actions" => '<div class="btn-group">
                            <a href="'.route('panel.models.edit', ['id' => $record->id, 'type' => $type]).'" type="button" class="btn btn-secondary dbtalbe_button">Düzenle</a>
                            <a href="'.route('panel.models.delete', $record->id).'" type="button" class="btn btn-secondary dbtalbe_button">Sil</a>
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

    public function editwomen($id, $type){
        if($type == 1) $type = 'panel.models.man'; else if($type == 2) $type = 'panel.models.women'; else if($type == 3) $type = 'panel.models.intown';
        else if($type == 4) $type = 'panel.models.timeless';
        $models = Modeldb::Find($id);
        $data = array(
            'type' => $type,
            'models' => $models
        );
        return view('admin.models.forms')->with($data);
    }

    public function updatewomen($id, Request $request){
        $req = $request->all();
        $models = Modeldb::Find($id);
        //print_r($models);
        //echo $req['name'];
        $models->name = $req['name'];
        $models->surname = $req['surname'];
        $models->birth_year = $req['birth_year'];
        $models->height = $req['height'];
        $models->body_size = $req['body_size'];
        $models->size = $req['size'];
        $models->shoes = $req['shoes'];
        $models->hair = $req['hair'];
        $models->hair_tr = $req['hair_tr'];
        $models->eyes = $req['eyes'];
        $models->eyes_tr = $req['eyes_tr'];
        $models->gender = $req['gender'];
        $models->type = $req['intown']; 
        $models->timeless = $req['timeless'];       
        $models->arrival = date('Y-m-d', strtotime($req['arrival']));
        $models->departure = date('Y-m-d', strtotime($req['departure']));
        $models->video_url = $req['video_url'];
        $models->instagram = $req['instagram'];
        $models->update();
        return back()->withInput();
        //return redirect()->route('models.women');
    }

    public function activemodel($id){
        $model = Modeldb::Find($id);
        //print_r($models);
        //echo $req['name'];
        $model->status = ($model->status == 1) ? 0 : 1;
        $model->update();
        return back()->withInput();
        //return redirect()->route('models.gallery', $id);
    }

    public function deletemodel($id){
        $model = Modeldb::Find($id);
        $model->delete();
        return back()->withInput();
        //return redirect()->route('models.poloraid', $id);
    }

    public function upmodel($id){
        $model = Modeldb::Find($id);
        if ($model->sort > 1){
            $temp = Modeldb::where('sort', ($model->sort-1))->first();
            $temp->sort = $model->sort;
            $model->sort = $model->sort - 1;
            $model->update();
            $temp->update();
        }
        return back()->withInput();
    }

    public function downmodel($id){
        $model = Modeldb::Find($id);
        $allmodel = count(Modeldb::get());
        if ($model->sort < $allmodel){
            $temp = Modeldb::where('sort', ($model->sort+1))->first();
            $temp->sort = $model->sort;
            $model->sort = $model->sort + 1;
            $model->update();
            $temp->update();
        }
        return back()->withInput();
    }

    public function inupmodel($id){
        $model = Modeldb::Find($id);
        if ($model->sort_intown > 1){
            $temp = Modeldb::where('sort_intown', ($model->sort_intown-1))->first();
            //echo $temp->sort_intown;
            //echo $model->sort_intown;
            $temp->sort_intown = $model->sort_intown;
            $model->sort_intown = $model->sort_intown - 1;
            $model->update();
            $temp->update();
            //echo $temp->sort_intown;
            //echo $model->sort_intown;
            $this->resortintown();
        }
        return back()->withInput();
    }

    public function indownmodel($id){
        $model = Modeldb::Find($id);
        $allmodel = count(Modeldb::get());
        if ($model->sort_intown < $allmodel){
            $temp = Modeldb::where('sort_intown', ($model->sort_intown+1))->first();
            $temp->sort_intown = $model->sort_intown;
            $model->sort_intown = $model->sort_intown + 1;
            $temp->save();
            $model->save();
            
            $this->resortintown();
        }
        return back()->withInput();
    }

    public function tmupmodel($id){
        $model = Modeldb::Find($id);
        if ($model->sort_timeless > 1){
            $temp = Modeldb::where('sort_timeless', ($model->sort_timeless-1))->first();
            $temp->sort_timeless = $model->sort_timeless;
            $model->sort_timeless = $model->sort_timeless - 1;
            $model->update();
            $temp->update();
        }
        return back()->withInput();
    }

    public function tmdownmodel($id){
        $model = Modeldb::Find($id);
        $allmodel = count(Modeldb::get());
        if ($model->sort_timeless < $allmodel){
            $temp = Modeldb::where('sort_timeless', ($model->sort_timeless+1))->first();
            $temp->sort_timeless = $model->sort_timeless;
            $model->sort_timeless = $model->sort_timeless + 1;
            $model->update();
            $temp->update();
        }
        return back()->withInput();
    }

    public function resort(){
        $models = Modeldb::orderBy('sort','ASC')->where('timeless', 0)->get();
        $c = 1;
        foreach ($models as $model) {
            $modeltemp = Modeldb::Find($model->id);
            $modeltemp->sort = $c;
            $modeltemp->update();
            $c++;
        }
        return true;
    }

    public function resortintown(){
        $models = Modeldb::orderBy('sort_intown','ASC')->where('type', 1)->where('timeless', 0)->get();
        $c = 1;
        foreach ($models as $model) {
            $modeltemp = Modeldb::Find($model->id);
            $modeltemp->sort_intown = $c;
            $modeltemp->update();
            $c++;
        }
        return true;
    }

    public function resorttimeless(){
        $models = Modeldb::orderBy('sort_timeless','ASC')->where('timeless', 1)->get();
        $c = 1;
        foreach ($models as $model) {
            $modeltemp = Modeldb::Find($model->id);
            $modeltemp->sort_timeless = $c;
            $modeltemp->update();
            $c++;
        }
        return true;
    }
}
