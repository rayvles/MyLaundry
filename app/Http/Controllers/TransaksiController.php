<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Paket;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Outlet;


class TransaksiController extends Controller
{

    // public function index(Outlet $outlet) {
    //     return view('outlet.transaksi.index', [
    //         'title' => 'Transaction',
    //         'member' => Member::get(),
    //         'outlet' => $outlet,
    //         'paket' => Paket::where('id_outlet', auth()->user()->id_outlet)->get()
    //     ]);
    // }
}
