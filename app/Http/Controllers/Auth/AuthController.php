<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User as ModelsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginForm(){
        return view('auth.login');
    }

    public function login(Request $req){
        $req->validate([
            'em' => 'required|email',
            'pw' => 'required',
        ]);
    
        if (auth()->attempt([
            'email' => $req->input('em'), 
            'password' => $req->input('pw')
        ])) {
            $us = auth()->user();
            session([
                'us_id' => $us->id,     
                'us_n' => $us->name,  
                'us_em' => $us->email,
            ]);
    
            return redirect()->route('home')->with('success','Đăng nhập thành công');
        }
    
        return back()->withErrors(['m' , 'Email hoặc mật khẩu không đúng.']);
    }
    
    public function registerForm(){
        return view('auth.register');
    }
    public function register(Request $req){
        $req->validate([
            'em' => 'required|email|unique:users,email',
            'n' => 'required|max:255',
            'pw' => 'required|min:8',
        ], [
            'em.required' => 'Bắt buộc',
            'n.required' =>'Bắt buộc',
            'pw.min' => 'Mật khẩu phải ít nhất 8 kí tự',
            'pw.required' => 'Bắt buộc',
        ]);

        ModelsUser::create([
            'name' => $req->input('n'),
            'email' => $req->input('em'),
            'password' => Hash::make($req->input('pw')),
            'role' => 'user'
        ]);
        auth()->attempt([
            'email' => $req->input('em'),
            'password' => $req->input('pw'),
        ]);
        return view('auth.login')->with('m', 'Đăng ký thành công');;
    }

    public function logout(){
        auth()->logout();
        session()->flush();
        return redirect()->route('login');
    }
}
