<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
    return view('welcome');
});

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
   //ORM
    // $users = User::all();
    
    //Query Builder
    $users = DB::table('users')->get();
    return view('dashboard',compact('users'));
})->name('dashboard');

//Category
Route::get('/category/all',[CategoryController::class, 'allCategory'])->name('all.category');

Route::post('/category/add',[CategoryController::class, 'addCategory'])->name('store.category');

Route::get('/category/edit/{id}',[CategoryController::class, 'editCategory'])->name('edit.category');

Route::post('/category/update/{id}',[CategoryController::class, 'updateCategory'])->name('update.category');

Route::get('/category/softdelete/{id}',[CategoryController::class, 'softdeleteCategory'])->name('softdelete.category');

Route::get('/category/restore/{id}',[CategoryController::class, 'restoreCategory'])->name('restore.category');
Route::get('/category/pdelete/{id}',[CategoryController::class, 'pdeleteCategory'])->name('pdelete.category');
