<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SimulasiController extends Controller
{

    public function index(){
        return view('admin.simulasi');
    }

    public function indexkedua(){
        return view('admin.simulasikedua');
    }

    /**
     * Membuat Function Untuk Menampilkan halaman Simulasi Programan Dasar karyawan.
     *
     */
    public function indexketiga(){
        return view('admin.simulasiketiga');
    }

    public function indexkeempat(){
        return view('admin.simulasikeempat');
    }
}
