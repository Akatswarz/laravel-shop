<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginForm(){
        return view('auth.login');
    }

    public function login(Request $request){
        return view('auth.login');
    }
    
    public function registerForm(){
        return view('auth.register');
    }
    public function register(Request $request){
        return view('auth.login');
    }

    public function logout(){
        return view('auth.login');
    }
}
