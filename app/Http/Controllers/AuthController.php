<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //auth login page
    public function login(){
        if(Auth::check()):
            return redirect()->route('auth#dashboard');
        endif;
            return view('login');


    }

    //auth register page
    public function register(){

        if(Auth::check()):
            return back();
        endif;
        return view('register');
    }

    //auth dashboard
    public function dashboard(){
        if(Auth::user()->role == 'admin'):
            return view('admin.dashboard');
        endif;
        return redirect()->route('customer#myaccount');
    }

}
