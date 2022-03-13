<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Paket;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Outlet;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Response;


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


    

        public function store(Request $request, Outlet $outlet) {
            $request['id_outlet']= auth()->user()->id_outlet;
            $request['kode_invoice']= Transaksi::createInvoice();
            $request['tgl']= date('Y-m-d');
            $request['status']= 'baru';
            $request['status_pembayaran']= $request->status_pembayaran;
            $request['id_user']=auth()->user()->id;
            $request['deadline']= $request->deadline;
    
    
            $input_transaksi = Transaksi::create($request->all());
            if($input_transaksi == NULL){
                return back()->withErrors([
                    'transaksi' => 'Input Transaksi Gagal',
                ]);
            }
    
            foreach($request->id_paket as $i => $v){
                $input_detail = TransaksiDetail::create([
                    'id_transaksi' => $input_transaksi->id,
                    'id_paket' => $v,
                    'qty' => $request->qty[$i],
                    'keterangan' => ''
                ]);
            }
            return redirect()->to("/outlet/$outlet->id/transaksi")->with('success','Input Transaction Succesfully!');
        }

        public function datatable(Request $request, Outlet $outlet)
        {
            $status = null;
            if ($request->has('status')) {
                switch ($request->status) {
                    case 'new':
                        $status = 'new';
                        break;
                    case 'process':
                        $status = 'process';
                        break;
                    case 'done':
                        $status = 'done';
                        break;
                    case 'taken':
                        $status = 'taken';
                        break;
                    default:
                        $status = null;
                }
            }
    
            $transactions = Transaksi::with(['user', 'member', 'details'])->where('id_outlet', $outlet->id)->when($status, function ($query) use ($status) {
                return $query->where('status', $status);
            })->get();
    
            return DataTables::of($transactions)
                ->addIndexColumn()
                ->addColumn('total_item', function ($transaction) {
                    return $transaction->details()->count();
                })
                ->addColumn('actions', function ($transaction) {
                    $buttons = '';
                    if ($transaction->status_pembayaran === 'belum_dibayar') {
                        $buttons .= '<button class="btn btn-success m-1 pay-button"><i class="fas fa-cash-register mr-1"></i><span>Bayar</span></button>';
                    }
                    $buttons .= '<button class="btn btn-info m-1 detail-button" data-id="' . $transaction->id . '"><i class="fas fa-eye mr-1"></i><span>Detail</span></button>';
                    return $buttons;
                })->rawColumns(['actions'])->make(true);
        }

        public function show(Outlet $outlet, Transaksi $transaction)
    {
        $transaction->load(['details', 'outlet', 'user', 'member']);
        return response()->json([
            'message' => 'Data Transaksi',
            'transaction' => $transaction
        ], Response::HTTP_OK);
    }
}
