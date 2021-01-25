<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function allCategory(){
        /* ORM */
        $categories = Category::latest()->paginate(5);
        $trashCategories =Category::onlyTrashed()->latest()->paginate(3);
        
        /* Query Builder */
        /* diffforhumans must use Carbon\Carbon::parse() */
        //$categories = DB::table('categories')->join('users','categories.user_id','users.id')->select('categories.*','users.name')->latest()->paginate(5);
        return view('admin.category.index',compact('categories','trashCategories'));
    }

    public function addCategory(Request $request){
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        
        ],
        [
            'category_name.required' => 'Please input Category Name',
            'category_name.max' => 'Must be less than 255 chars',
        
        ]
    );

    /* ORM */
    Category::insert([
        'category_name'=>$request->category_name,
        'user_id' => Auth::user()->id,
        'created_at'=> Carbon::now(),
    ]);

   /*  $category = new Category;
    $category->category_name = $request->category_name;
    $category->user_id = Auth::user()->id;
    $category->save();
     */

     /* Query Builder */
     /* $data = array();
     $data['category_name'] = $request->category_name;
     $data['user_id'] = Auth::user()->id;
     DB::table('categories')->insert($data); */

     return Redirect()->back()->with('success','Category inserted successfully!');

    }

    public function editCategory($id){
        /* ORM */
        //$category = Category::find($id);

        /* QB */
        $category = DB::table('categories')->where('id',$id)->first();

        return view('admin.category.edit',compact('category'));
    }

    public function updateCategory(Request $request, $id){
        /* ORM */
        /* $update = Category::find($id)->update([
            'category_name'=>$request->category_name,
            'user_id' =>Auth::user()->id,
        ]); */

        /* QB */
        $data =array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->where('id',$id)->update($data);

        return Redirect()->route('all.category')->with('success','Category updated successfully!');
    }

    public function softdeleteCategory($id){
        $delete = Category::find($id)->delete();
        return Redirect()->back()->with('success','Category soft deleted successfully!'); 
    }

    public function restoreCategory($id){
        $restore = Category::withTrashed()->find($id)->restore();

        return Redirect()->back()->with('success','Category restore successfully!'); 
    }

    public function pdeleteCategory($id){
        $restore = Category::onlyTrashed()->find($id)->forceDelete();

        return Redirect()->back()->with('success','Category permanently deleted successfully!'); 
    }

}
