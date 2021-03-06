<?php

namespace App\Http\Controllers;

use App\Exports\PaketExport;
use App\Models\Outlet;
use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;
class PaketController extends Controller
{
     /**
     * Membuat Function Untuk Menampilkan Halaman Paket
     *
     * @param  \App\Models\Outlet  $outlet
     */
    public function index(Outlet $outlet)
    {
        Gate::authorize('manage-user');
        return view('outlet.paket', [
            'title' => 'Paket',
            'outlet' => $outlet,
        ]);
    }

    /**
     * Membuat Function Untuk Menambahkan Data Paket
     *
     * @param  \App\Models\Outlet  $outlet
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Outlet $outlet)
    {
        $request->validate([
            'nama_paket' => 'required',
            'jenis' => 'required|in:kaos,bed_cover,selimut,lainnya',
            'harga' => 'numeric|min:0'
        ]);

        $outlet->paket()->create([
            'nama_paket' => $request->nama_paket,
            'jenis' => $request->jenis,
            'harga' => $request->harga,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Packets successfully added!'
        ], Response::HTTP_OK);
    }

     /**
     * Membuat Function Untuk Menampilkan Data Paket pada Datatable.
     *
     * @param  \App\Models\Outlet  $outlet
     */
    public function data(Outlet $outlet)
    {
        $paket = $outlet->paket;
        return DataTables::of($paket)
            ->addIndexColumn()
            ->addColumn('nama_outlet', function () use ($outlet) {
                return $outlet->nama;
            })
            ->addColumn('action', function ($paket) use ($outlet) {
                $editBtn = '<button onclick="editHandler(' . "'" . route('paket.update', [$outlet->id, $paket->id]) . "'" . ')" class="btn btn-success mx-1">
                    <i class="fas fa-edit"></i>
                    <span>Edit Packet</span>
                </button>';
                $deletBtn = '<button onclick="deleteHandler(' . "'" . route('paket.destroy', [$outlet->id, $paket->id]) . "'" . ')" class="btn btn-danger mx-1">
                    <i class="fas fa-trash"></i>
                    <span>Delete Packet</span>
                </button>';
                return $editBtn . $deletBtn;
            })->rawColumns(['action'])->make(true);
    }

     /**
     * Membuat Function Untuk Menampilkan Data Paket.
     *
     * @param  \App\Models\Outlet  $outlet
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function show(Outlet $outlet, Paket $paket)
    {
        return response()->json([
            'success' => true,
            'message' => 'Data paket',
            'paket' => $paket
        ], Response::HTTP_OK);
    }

     /**
     * Membuat Function Untuk Mengupdate Data Paket
     *
     * @param  \App\Models\Outlet  $outlet
     * @param  \App\Models\Paket  $paket
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Outlet $outlet, Paket $paket)
    {
        $request->validate([
            'nama_paket' => 'required',
            'jenis' => 'required|in:kaos,bed_cover,selimut,lainnya',
            'harga' => 'numeric|min:0'
        ]);

        $paket->update([
            'nama_paket' => $request->nama_paket,
            'jenis' => $request->jenis,
            'harga' => $request->harga,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Packets successfully updated!'
        ], Response::HTTP_OK);
    }


    /**
     * Membuat Function Untuk Meng Delete Data Paket
     *
     * @param  \App\Models\Outlet  $outlet
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outlet $outlet, Paket $paket)
    {
        if ($paket->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Packets successfully deleted!'
            ], Response::HTTP_OK);
        };

        return response()->json([
            'success' => false,
            'message' => 'Error'
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function exportExcel(Outlet $outlet)
    {
        return (new PaketExport)->whereOutlet($outlet->id)->download('Paket-' . date('d-m-Y') . '.xlsx');
    }

}
