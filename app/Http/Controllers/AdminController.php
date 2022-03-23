<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
     /**
     * Membuat Function Untuk Menampilkan Halaman Admin
     *
     */
    public function index(){
        return view('admin.house');
    }
}
