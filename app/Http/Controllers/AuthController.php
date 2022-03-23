<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
     /**
     * Membuat Function Untuk Menampilkan Halaman Login
     */
    public function login(){
        return view('login');
    }

     /**
     * Membuat Function Untuk Mengauthentikasi 
     *
     * @param  \Illuminate\Http\Request  $request
     */
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

     /**
     * Membuat Function Untuk Logout
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}