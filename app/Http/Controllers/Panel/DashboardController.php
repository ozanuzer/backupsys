<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hosting;
use App\Models\Schedule;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $hosting = count(Hosting::where('status', 1)->get());
        $schedule = count(Schedule::all());
        $data = array(
            'hosting' => $hosting,
            'schedule' => $schedule
        );
        //dd(auth()->user()->id );
        return view('admin.dashboard')->with($data);
    }

    public function changetheme(Request $request){
        $req = $request->all();
        $userId = \Auth::user()->id;
        $cuser = User::Find($userId);
        $cuser->paneltheme = $req['theme'];
        $cuser->update();
        return response()->json([
            'success' => 'true'
        ]);
    }
}
