<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function adminContact(){
        $contacts = Contact::all();
        return view('admin.contact.index',compact('contacts'));
    }
}
