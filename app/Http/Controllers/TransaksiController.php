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

    public function index(Outlet $outlet) {
        return view('outlet.transaksi.index', [
            'title' => 'Transaction',
            'member' => Member::get(),
            'outlet' => $outlet,
            'paket' => Paket::where('id_outlet', auth()->user()->id_outlet)->get()
        ]);
    }


    

        // public function store(Request $request, Outlet $outlet) {
        //     $request['id_outlet']= auth()->user()->id_outlet;
        //     $request['kode_invoice']= Transaksi::createInvoice();
        //     $request['tgl']= date('Y-m-d');
        //     $request['status']= 'baru';
        //     $request['status_pembayaran']= $request->status_pembayaran;
        //     $request['id_user']=auth()->user()->id;
        //     $request['deadline']= $request->deadline;
    
    
        //     $input_transaksi = Transaksi::create($request->all());
        //     if($input_transaksi == NULL){
        //         return back()->withErrors([
        //             'transaksi' => 'Input Transaksi Gagal',
        //         ]);
        //     }
    
        //     foreach($request->id_paket as $i => $v){
        //         $input_detail = TransaksiDetail::create([
        //             'id_transaksi' => $input_transaksi->id,
        //             'id_paket' => $v,
        //             'qty' => $request->qty[$i],
        //             'keterangan' => ''
        //         ]);
        //     }
        //     return redirect()->to("/outlet/$outlet->id/transaksi")->with('success','success');
        // }
}
