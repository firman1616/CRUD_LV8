<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function index() 
    {
        return view("login");
    }

    function loginproses(Request $request)  
    {
        if (Auth::attempt($request->only('email','password'))) {
            return redirect('/');
        }    
        return redirect('login');
    }

    function register() {
        return view('register');
    }

    function registeruser(Request $request) {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(60)
        ]);

        return redirect('/login');
    }

    function logout() 
    {
        Auth::logout();
        return redirect('login');
    }
}
