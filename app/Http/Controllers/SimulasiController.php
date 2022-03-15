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

    public function indexketiga(){
        return view('admin.simulasiketiga');
    }
}
