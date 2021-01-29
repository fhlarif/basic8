<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Image;

class HomeController extends Controller
{
    public function homeSlider(){
        $sliders = Slider::latest()->paginate(5);
        return view('admin.slider.index',compact('sliders'));
    }

    public function addSlider(){
       // dd('hello');
        return view('admin.slider.create');
    }

    public function storeSlider(Request $request){
  
        $slider_image = $request->file('image');

        /* Using Image Intervention */
        $name_gen = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
        Image::make($slider_image)->resize(1920,1088)->save('image/slider/'.$name_gen);
        $final_img = 'image/slider/'.$name_gen;

        Slider::insert([
            'title'=>$request->title,
            'description'=>$request->description,
            'image'=>$final_img,
            'created_at'=>Carbon::now(),
        ]);

        return Redirect()->route('home.slider')->with('success','Slider inserted successfully');

    }

    public function editSlider($id){
        $sliders = Slider::find($id);
        return view('admin.slider.edit',compact('sliders'));
    }

    public function updateSlider(Request $request, $id){

        $validated = $request->validate([
            'title' => 'required|min:4',
            'description' => 'required|min:4',
        
        ],
        [
            'title.required' => 'Please input title ',
            'title.max' => 'Must be longer than 4 chars',
        
        ]
    );

        $old_image = $request->old_image; 

        $image = $request->file('image');

        if ($image) {
        
       /* Using Image Intervention */
       $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
       Image::make($image)->resize(1920,1088)->save('image/slider/'.$name_gen);
       $final_img = 'image/slider/'.$name_gen;

        unlink($old_image);

        Slider::find($id)->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'image'=>$final_img,
            'created_at'=>Carbon::now(),
        ]);

        return Redirect()->route('home.slider')->with('success','Slider updated successfully');
        } 
        else {
            Slider::find($id)->update([
                'title'=>$request->title,
            'description'=>$request->description,
            'created_at'=>Carbon::now(),
            ]);
    
            return Redirect()->route('home.slider')->with('success','Slider updated successfully');
        }
    }

    public function deleteSlider($id){
        $image = Slider::find($id);
        $old_image = $image->image;
        //dd($image,$id,$old_image);
        unlink($old_image);

        Slider::find($id)->forceDelete();

        return Redirect()->route('home.slider')->with('success','Slider permanently deleted successfully!'); 
    }
}
