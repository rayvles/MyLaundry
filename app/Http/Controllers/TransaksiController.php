<?php

namespace App\Http\Controllers;

use App\Exports\TransaksiExport;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Paket;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Outlet;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Response;
use Barryvdh\DomPDF\Facade\Pdf;


class TransaksiController extends Controller
{

    /**
     * Menampilkan Halaman Transaksi.
     *
     * @param  \App\Models\Outlet  $outlet
     */
    public function index(Outlet $outlet) {
        return view('outlet.transaksi.index', [
            'title' => 'Transaction',
            'member' => Member::get(),
            'outlet' => $outlet,
            'paket' => Paket::where('id_outlet', auth()->user()->id_outlet)->get()
        ]);
    }



    /**
     * Membuat Function Untuk Menambahkan Data Transaksi.
     *
     * @param  \App\Models\Outlet  $outlet
     * @param  \Illuminate\Http\Request  $request
     */
        public function store(Request $request, Outlet $outlet) {
            $request['id_outlet']= auth()->user()->id_outlet;
            $request['kode_invoice']= Transaksi::createInvoice();
            $request['tgl']= date('Y-m-d');
            $request['status']= 'baru';
            $request['status_pembayaran']= $request->status_pembayaran;
            $request['id_user']=auth()->user()->id;
            $request['deadline']= $request->deadline;
            $request['tgl_bayar']= $request->tgl_bayar;


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

        /**
     * Membuat Function Untuk Menambahkan Data Transaksi pada Datatable.
     *
     * @param  \App\Models\Outlet  $outlet
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
        public function datatable(Request $request, Outlet $outlet)
        {
            $status = null;
            if ($request->has('status')) {
                switch ($request->status) {
                    case 'baru':
                        $status = 'baru';
                        break;
                    case 'proses':
                        $status = 'proses';
                        break;
                    case 'selesai':
                        $status = 'selesai';
                        break;
                    case 'diambil':
                        $status = 'diambil';
                        break;
                    default:
                        $status = null;
                }
            }

            $transactions = Transaksi::with(['user', 'member', 'details'])->where('id_outlet', $outlet->id)->when($status, function ($query) use ($status) {
                return $query->where('status', $status);
            })->orderBy('id', 'desc')->get();

            return DataTables::of($transactions)
                ->addIndexColumn()
                ->editColumn('tgl', function ($transaction) {
                    return date('d/m/Y', strtotime($transaction->tgl));
                })
                ->editColumn('deadline', function ($transaction) {
                    return date('d/m/Y', strtotime($transaction->deadline));
                })
                ->addColumn('actions', function ($transaction) use ($outlet) {
                    $buttons = '';
                    if ($transaction->status_pembayaran === 'belum_dibayar') {
                        $buttons .= '<button class="btn btn-success btn-sm m-1 update-payment-button" data-detail-url="' . route('transaksi.show', [$outlet->id, $transaction->id]) . '" data-update-payment-url="

                        "><i class="fas fa-cash-register mr-1"></i><span>Bayar</span></button>';
                    }
                    if ($transaction->status !== 'taken') {
                        $buttons .= '<button class="btn btn-primary btn-sm m-1 update-status-button" data-update-url="

                        " data-status="'
                        . $transaction->status . '
                        "><i class="fas fa-arrow-circle-right mr-1"></i><span>Proses</span></button>';
                    }
                    $buttons .= '<button class="btn btn-info btn-sm m-1 detail-button" data-detail-url="

                    "><i class="fas fa-eye mr-1"></i><span>Detail</span></button>';
                    return $buttons;
                })->rawColumns(['actions'])->make(true);
        }

        /**
     * Membuat Function Untuk Menampilkan Data Transaksi.
     *
     * @param  \App\Models\Outlet  $outlet
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
        public function show(Outlet $outlet, Transaksi $transaction)
    {
        $transaction->load(['details', 'outlet', 'user', 'member']);
        $transaction['tgl'] = date('d/m/Y', strtotime($transaction->tgl));
        $transaction['deadline'] = date('d/m/Y', strtotime($transaction->deadline));
        $transaction['diskon'] = $transaction->diskon;
        $transaction['pajak'] = $transaction->pajak;
        return response()->json([
            'message' => 'Data Transaksi',
            'transaksi' => $transaction
        ], Response::HTTP_OK);
    }

     /**
     * Membuat Function Untuk Menampilkan Halaman Report Transaksi.
     *
     * @param  \App\Models\Outlet  $outlet
     */
    public function report(Outlet $outlet)
    {
        return view('outlet.transaksi.report', [
            'title' => 'Laporan Transaksi',
            'outlet' => $outlet,
        ]);
    }

     /**
     * Membuat Function Untuk Menampilkan Data Transaksi pada Datatable.
     *
     * @param  \App\Models\Outlet  $outlet
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reportDatatable(Request $request, Outlet $outlet)
    {
        $dateStart = ($request->has('date_start') && $request->date_start != "") ? $request->date_start : date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));
        $dateEnd = ($request->has('date_end') && $request->date_end != "") ? $request->date_end : date('Y-m-d');

        $transactions = Transaksi::whereBetween('tgl', [$dateStart, $dateEnd])->get();

        return DataTables::of($transactions)
            ->addIndexColumn()
            ->editColumn('date', function ($transaction) {
                return date('d/m/Y', strtotime($transaction->tgl));
            })
            ->editColumn('deadline', function ($transaction) {
                return date('d/m/Y', strtotime($transaction->deadline));
            })
            ->addColumn('total_payment', function ($transaction) {
                return $transaction->getTotalPayment();
            })
            ->addColumn('total_item', function ($transaction) {
                return $transaction->details()->count();
            })->rawColumns(['actions'])->make(true);
    }

    /**
     * Simpan data transaksi sebagai file excel (.xlsx)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Outlet  $outlet
     * @return \App\Exports\MembersExport
     */
    public function exportExcel(Request $request, Outlet $outlet)
    {
        $dateStart = ($request->has('date_start') && $request->date_start != "") ? $request->date_start : date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));
        $dateEnd = ($request->has('date_end') && $request->date_end != "") ? $request->date_end : date('Y-m-d');

        return (new TransaksiExport)->whereOutlet($outlet->id)->setDateStart($dateStart)->setDateEnd($dateEnd)->download('Transaksi-' . $dateStart . '-' . $dateEnd . '.xlsx');
    }

    /**
     * Simpan data transaksi sebagai file pdf
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Outlet  $outlet
     * @return \Barryvdh\DomPDF\Facade\Pdf
     */
    public function exportPDF(Request $request, Outlet $outlet)
    {
        $dateStart = ($request->has('date_start') && $request->date_start != "") ? $request->date_start : date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));
        $dateEnd = ($request->has('date_end') && $request->date_end != "") ? $request->date_end : date('Y-m-d');

        $transactions = Transaksi::where('id_outlet', $outlet->id)->whereBetween('tgl', [$dateStart, $dateEnd])->with('details')->get();

        $pdf = Pdf::loadView('outlet.transaksi.pdf', ['transactions' => $transactions, 'outlet' => $outlet, 'dateStart' => $dateStart, 'dateEnd' => $dateEnd]);
        return $pdf->stream('Transaksi-' . $dateStart . '-' . $dateEnd . '.pdf');
    }

}
