<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class UserLogout extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function userLogout(){
        Auth::logout();
        return Redirect()->route('login')->with('success','Logout successfully');
    }    
}
