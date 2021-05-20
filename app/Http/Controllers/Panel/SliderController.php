<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider_gallery;
use ImageOptimizer;
use File;

class SliderController extends Controller
{
    public function index(){
        $img1 = Slider_gallery::find(1);
        $img2 = Slider_gallery::find(2);        
        $data = array(
            'title' => 'Slider',
            'type' => '2',
            'slide1' => $img1,
            'slide2' => $img2
        );
        return view('admin.slider.index')->with($data);
    }

    public function store(Request $request){       
        
        if ($_FILES["image"]["size"] > 0) {
            $imageName = time().substr(md5(uniqid(rand(1,6))), 0, 6).'.'.$request->image->extension();     
            $request->image->move(public_path('images/slider/'), $imageName);
            if ($_FILES["image"]["size"] > 250000)
                ImageOptimizer::optimize(public_path('images/slider/').$imageName, public_path('images/slider/optimize/').$imageName);
            else 
                File::copy(public_path('images/slider/').$imageName, public_path('images/slider/optimize/').$imageName);        
            //print_r($models);
            //echo $req['name'];
            $img1 = Slider_gallery::find(1);
            //return $img1;
            if (empty($img1)) {
                $imagedb1 = new Slider_gallery;
                $imagedb1->slider_position = 1;
                $imagedb1->path = $imageName;
                $imagedb1->sort = 0;
                $imagedb1->status = 1;
                $imagedb1->save();
            } else {
                $img1->path = $imageName;
                $img1->update();
            }
        }

        if ($_FILES["image2"]["size"] > 0) {
            $imageName2 = time().substr(md5(uniqid(rand(1,6))), 0, 6).'.'.$request->image2->extension();     
            $request->image2->move(public_path('images/slider/'), $imageName2);
            if ($_FILES["image2"]["size"] > 250000)
                ImageOptimizer::optimize(public_path('images/slider/').$imageName2, public_path('images/slider/optimize/').$imageName2);
            else 
                File::copy(public_path('images/slider/').$imageName2, public_path('images/slider/optimize/').$imageName2);
            $img2 = Slider_gallery::find(2);
            if (empty($img2)) {
                $imagedb2 = new Slider_gallery;
                $imagedb2->slider_position = 2;
                $imagedb2->path = $imageName2;
                $imagedb2->sort = 0;
                $imagedb2->status = 1;
                $imagedb2->save();
            } else {
                $img2->path = $imageName2;
                $img2->update();
            }
        }
        return redirect()->route('panel.slider');
    }
}
