<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if (Auth::attempt($request->only(['email', 'password']), $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }



        return redirect()->back()->withInput()->withErrors([
            'email' => 'Email or password wrong!'
        ]);
    }
}
