<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Halaman Admin
    public function index(){
        return view('admin.house');
    }
}
