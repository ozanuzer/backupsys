<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Modeldb;
use App\Models\Newsletter;

class DashboardController extends Controller
{
    public function index()
    {
        /*$model = count(Modeldb::where('status', 1)->get());
        $news = count(Newsletter::where('status', 1)->get());
        $data = array(
            'model' => $model,
            'news' => $news
        );*/
        return view('admin.dashboard');//->with($data);
    }
}
