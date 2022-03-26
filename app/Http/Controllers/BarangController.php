<?php

namespace App\Http\Controllers;

use App\Exports\BarangExport;
use App\Imports\BarangImport;
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



        return redirect()->route('barang.index');
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
        // dd($request, $barang);
        return redirect()->route('barang.index');
    }

    /**
     * Membuat Function Untuk Mengupdate Status Penjemputan Laundry.
     *
     * @param  \App\Models\Barang  $barang
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, Barang $barang)
    {
        $request->validate([
            'status_barang' => 'required',
        ]);

        // $barang->update([
        //     'status_barang' => $request->status_barang,
        // ]);

        // if ($barang->update()) {
        //     return response()->json([
        //         'success' => true,
        //         'message' => 'Status Barang successfully Changed!'
        //     ], Response::HTTP_OK);
        // };

        $payload = [
            'status_barang' => $request->status_barang,
        ];

        if ($barang->status_barang !== $request->status_barang) {
            $payload['waktu_updated_status'] = now();
        }

        $barang->update($payload);

        return response()->json([
            'message' => 'Status Barang successfully Changed!',
            'waktu_updated_status' =>  date('Y-m-d H:i:s', strtotime($barang->waktu_updated_status)),
        ], Response::HTTP_OK);

        return response()->json([
            'message' => 'Errors occurred'
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }



    /**
     * Membuat Function Untuk Menghapus Data Data Barang.
     *
     * @param  \App\Models\Barang  $barang
     */
    public function destroy(Barang $barang)
    {
        if ($barang->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Data Barang successfully removed!'
            ], Response::HTTP_OK);
        };

        return response()->json([
            'message' => 'Errors occurred'
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function exportExcel()
    {
        return (new BarangExport)->download('Data-Barang-' . date('d-m-Y') . '.xlsx');
    }

    /**
     * Membuat Function Untuk Mengimport Data Barang dengan format file xlsx.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function importExcel(Request $request)
    {
        $request->validate([
            'file_import' => 'required|file|mimes:xlsx'
        ]);

        Excel::import(new BarangImport, $request->file('file_import'));

        return redirect()->route('barang.index');
    }
}
