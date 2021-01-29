<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserLogout;
use App\Models\Multipic;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\AssignOp\Mul;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $brands = DB::table('brands')->get();
    $abouts = DB::table('home_abouts')->first();
    $images = Multipic::all();
    return view('home',compact('brands','abouts','images'));
});

/* Route::get('/phpinfo', function () {
    echo 'hello';
    $i=1;
    $i++; 
    phpinfo();
}); */

Route::get('/home', function () {
    echo 'This is redirect to home because middleware';
});

/* Route::get('/about', function(){
    return view('about');
})->middleware('check'); */
Route::get('/about', function(){
    return view('about');
});

Route::get('/contact-yeyeg3483923bfdbcdusf',[ContactController::class, 'index'])->name('contact');

/* Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
   //ORM
    // $users = User::all();
    
    //Query Builder
    $users = DB::table('users')->get();
    return view('dashboard',compact('users'));
})->name('dashboard'); */

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

     return view('admin.index');
 })->name('dashboard');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

//Category
Route::get('/category/all',[CategoryController::class, 'allCategory'])->name('all.category');
Route::post('/category/add',[CategoryController::class, 'addCategory'])->name('store.category');
Route::get('/category/edit/{id}',[CategoryController::class, 'editCategory'])->name('edit.category');
Route::post('/category/update/{id}',[CategoryController::class, 'updateCategory'])->name('update.category');
Route::get('/category/softdelete/{id}',[CategoryController::class, 'softdeleteCategory'])->name('softdelete.category');
Route::get('/category/restore/{id}',[CategoryController::class, 'restoreCategory'])->name('restore.category');
Route::get('/category/pdelete/{id}',[CategoryController::class, 'pdeleteCategory'])->name('pdelete.category');

//Brand
Route::get('/brand/all',[BrandController::class, 'allBrand'])->name('all.brand');
Route::post('/brand/add',[BrandController::class, 'addBrand'])->name('add.brand');
Route::get('/brand/edit/{id}',[BrandController::class, 'editBrand'])->name('edit.brand');
Route::post('/brand/update/{id}',[BrandController::class, 'updateBrand'])->name('update.brand');
Route::get('/brand/softdelete/{id}',[BrandController::class, 'softdeleteBrand'])->name('softdelete.brand');
Route::get('/brand/restore/{id}',[BrandController::class, 'restoreBrand'])->name('restore.brand');
Route::get('/brand/pdelete/{id}',[BrandController::class, 'pdeleteBrand'])->name('pdelete.brand');

//Multipic
Route::get('/multipic/all',[BrandController::class, 'allMultipic'])->name('all.multipic');
Route::post('/multipic/add',[BrandController::class, 'addMultipic'])->name('add.multipic');
Route::get('/multipic/softdelete/{id}',[BrandController::class, 'softdeleteMultipic'])->name('softdelete.multipic');
Route::get('/multipic/restore/{id}',[BrandController::class, 'restoreMultipic'])->name('restore.multipic');
Route::get('/multipic/pdelete/{id}',[BrandController::class, 'pdeleteMultipic'])->name('pdelete.multipic');

//Slider
Route::get('/home/slider',[HomeController::class, 'homeSlider'])->name('home.slider');
Route::get('/add/slider',[HomeController::class, 'addSlider'])->name('add.slider');
Route::post('/store/slider',[HomeController::class, 'storeSlider'])->name('store.slider');
Route::get('/edit/slider/{id}',[HomeController::class, 'editSlider'])->name('edit.slider');
Route::post('/update/slider/{id}',[HomeController::class, 'updateSlider'])->name('update.slider');
Route::get('/delete/slider/{id}',[HomeController::class, 'deleteSlider'])->name('delete.slider');

//Home About
Route::get('/home/about',[AboutController::class, 'homeAbout'])->name('home.about');
Route::get('/add/about',[AboutController::class, 'addAbout'])->name('add.about');
Route::post('/store/about',[AboutController::class, 'storeAbout'])->name('store.about');
Route::get('/edit/about/{id}',[AboutController::class, 'editAbout'])->name('edit.about');
Route::post('/update/about/{id}',[AboutController::class, 'updateAbout'])->name('update.about');
Route::get('/delete/about/{id}',[AboutController::class, 'deleteAbout'])->name('delete.about');

//Portfolio
Route::get('/portfolio',[AboutController::class, 'Portfolio'])->name('portfolio');

//User Logout
Route::get('/user/logout',[UserLogout::class, 'userLogout'])->name('user.logout');



//Test Livewire
Route::get('test', function () {

    return view('default');

});