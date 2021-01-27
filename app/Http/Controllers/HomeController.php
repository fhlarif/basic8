<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function homeSlider(){
        $sliders = Slider::latest()->paginate(5);
        return view('admin.slider.index',compact('sliders'));
    }
}
