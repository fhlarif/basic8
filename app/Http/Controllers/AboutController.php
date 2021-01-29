<?php

namespace App\Http\Controllers;

use App\Models\HomeAbout;
use App\Models\Multipic;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Expr\AssignOp\Mul;

class AboutController extends Controller
{
    public function homeAbout(){
        $homeabout =HomeAbout::latest()->get();
        return view('admin.about.index',compact('homeabout'));
    }

    public function addAbout(){
        return view('admin.about.create');
    }

    public function storeAbout(Request $request){
        HomeAbout::insert([
            'title'=>$request->title,
            'short_desc'=>$request->short_desc,
            'long_desc'=>$request->long_desc,
            'created_at'=>Carbon::now(),

        ]);

        return Redirect()->route('home.about')->with('success','About inserted successfully');
    }

    public function editAbout($id){
        $homeabout = HomeAbout::find($id);
        return view('admin.about.edit',compact('homeabout'));
    }

    public function updateAbout(Request $request, $id){
        HomeAbout::find($id)->update([
            'title'=>$request->title,
            'short_desc'=>$request->short_desc,
            'long_desc'=>$request->long_desc,

        ]);

        return Redirect()->route('home.about')->with('success','About updated successfully');

    }

    public function deleteAbout($id){
        HomeAbout::find($id)->Delete();
        return Redirect()->back()->with('success','About deleted successfully');

    }

    public function Portfolio(){
        $images= Multipic::all();
        return view('pages.portfolio',compact('images'));
    }
}
