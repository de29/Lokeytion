<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class StaticController extends Controller
{
    
    public function index(){
        if(!empty(Session::get('loginID'))){
            return redirect()->route('annonces',['id' => Session::get('loginID')]);
        }
        else{
            return view('index');}
    }
    public function login(){
        return view('login');
    }

}
