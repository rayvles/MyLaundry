<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class BarangController extends Controller
{
    public function index() {
        $barang = Barang::get();
        return view('admin.databarang', [
            'title' => 'Data Barang',
            'data_barang' => $barang,
        ]);
    }

    /**
     * Membuat Function Untuk Menambahkan data Barang
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|',
            'qty' => 'required|',
            'harga' => 'required|',
            'waktu_beli' => 'required|',
            'supplier' => 'required|',
            'status_barang' => 'required|',
        ]);

        Barang::create([
            'nama_barang' => $request->nama_barang,
            'qty' => $request->qty,
            'harga' => $request->harga,
            'waktu_beli' => $request->waktu_beli,
            'supplier' => $request->supplier,
            'status_barang' => $request->status_barang,
        ]);



        return redirect()->route('databarang.index');
    }

    public function update(Request $request, Barang $barang)
    {

        $request->validate([
            'nama_barang' => 'required',
            'qty' => 'required',
            'harga' => 'required',
            'waktu_beli' => 'required',
            'supplier' => 'required',
            'status_barang' => 'required',
            'waktu_updated_status' => 'required',

        ]);


        $barang->update([
            'nama_barang' => $request->nama_barang,
            'qty' => $request->qty,
            'harga' => $request->harga,
            'waktu_beli' => $request->waktu_beli,
            'supplier' => $request->supplier,
            'status_barang' => $request->status_barang,
            'waktu_updated_status' => $request->waktu_updated_status,
        ]);
        dd($request, $barang);
        // return redirect()->route('databarang.index');
    }

    public function updateStatus(Request $request, Barang $barang)
    {
        $request->validate([
            'status_barang' => 'required',
        ]);

        $barang->update([
            'status_barang' => $request->status_barang,
        ]);

        if ($barang->update()) {
            return response()->json([
                'success' => true,
                'message' => 'Status Barang successfully Changed!'
            ], Response::HTTP_OK);
        };

        return response()->json([
            'message' => 'Errors occurred'
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
