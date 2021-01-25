<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Multipic;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Image;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function allBrand(){

        $brands = Brand::latest()->paginate(5);
        $trashBrands =Brand::onlyTrashed()->latest()->paginate(3);

        return view('admin.brand.index',compact('brands','trashBrands'));
    }

    public function addBrand(Request $request){
        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required|mimes:jpg,jpeg,png',
        
        ],
        [
            'brand_name.required' => 'Please input Brand Name',
            'brand_name.max' => 'Must be longer than 4 chars',
        
        ]
    );
        $brand_image = $request->file('brand_image');
        
        /* $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        //$img_real_name = strtolower($brand_image->getClientOriginalName());
        $img_name =$name_gen.'.'.$img_ext;
        $upload_location = 'image/brand/';
        $final_img =$upload_location.$img_name;
        $brand_image->move($upload_location,$img_name); */

        /* Using Image Intervention */
        $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(300,200)->save('image/brand/'.$name_gen);
        $final_img = 'image/brand/'.$name_gen;

        Brand::insert([
            'brand_name'=>$request->brand_name,
            'brand_image'=>$final_img,
            'created_at'=>Carbon::now(),
        ]);

        return Redirect()->back()->with('success','Brand inserted successfully');

    }

    public function editBrand($id){
        $brands = Brand::find($id);
        return view('admin.brand.edit',compact('brands'));
    }

    public function updateBrand(Request $request, $id){

        $validated = $request->validate([
            'brand_name' => 'required|min:4',
        
        ],
        [
            'brand_name.required' => 'Please input Brand Name',
            'brand_name.max' => 'Must be longer than 4 chars',
        
        ]
    );

        $old_image = $request->old_image; 

        $brand_image = $request->file('brand_image');

        if ($brand_image) {
        
       $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        //$img_real_name = strtolower($brand_image->getClientOriginalName());
        $img_name =$name_gen.'.'.$img_ext;
        $upload_location = 'image/brand/';
        $final_img =$upload_location.$img_name;
        $brand_image->move($upload_location,$img_name);

        unlink($old_image);

        Brand::find($id)->update([
            'brand_name'=>$request->brand_name,
            'brand_image'=>$final_img,
            'created_at'=>Carbon::now(),
        ]);

        return Redirect()->back()->with('success','Brand inserted successfully');
        } 
        else {
            Brand::find($id)->update([
                'brand_name'=>$request->brand_name,
                'created_at'=>Carbon::now(),
            ]);
    
            return Redirect()->back()->with('success','Brand inserted successfully');
        }
    }

    public function softdeleteBrand($id){
        $delete = Brand::find($id)->delete();
        return Redirect()->back()->with('success','Brand soft deleted successfully!'); 
    }

    public function restoreBrand($id){
        $restore = Brand::withTrashed()->find($id)->restore();

        return Redirect()->back()->with('success','Brand restore successfully!'); 
    }

    public function pdeleteBrand($id){
        $image = Brand::onlyTrashed()->find($id);
        $old_image = $image->brand_image;
        //dd($image,$id,$old_image);
        unlink($old_image);

        $pdelete = Brand::onlyTrashed()->find($id)->forceDelete();

        return Redirect()->back()->with('success','Brand permanently deleted successfully!'); 
    }


    //MultiPic
    public function allMultipic(){
        $multipic = Multipic::latest()->paginate(12);

        $trashmultipic =Multipic::onlyTrashed()->latest()->paginate(3);
        return view('admin.multipic.index',compact('multipic','trashmultipic'));
    }

    public function addMultipic(Request $request){
        
        $multipic = $request->file('multipic');
        
        foreach ($multipic as $image) {
           /* Using Image Intervention */
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,200)->save('image/multipic/'.$name_gen);
        $final_img = 'image/multipic/'.$name_gen;

        Multipic::insert([
            'image'=>$final_img,
            'created_at'=>Carbon::now(),
        ]);
        }
  
        return Redirect()->back()->with('success','Brand images inserted successfully');

    }

    public function softdeleteMultipic($id){
        $delete = Multipic::find($id)->delete();
        return Redirect()->back()->with('success','Brand soft deleted successfully!'); 
    }

    public function restoreMultipic($id){
        $restore = Multipic::withTrashed()->find($id)->restore();

        return Redirect()->back()->with('success','Brand restore successfully!'); 
    }

    public function pdeletemultipic($id){
        $image = Multipic::onlyTrashed()->find($id);
        $old_image = $image->image;
        //dd($image,$id,$old_image);
        $pdelete = Multipic::onlyTrashed()->find($id)->forceDelete();
        unlink($old_image);
        return Redirect()->back()->with('success','Brand permanently deleted successfully!'); 
    }
}
