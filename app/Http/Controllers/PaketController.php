<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;
class PaketController extends Controller
{
    public function index(Outlet $outlet)
    {
        return view('outlet.paket', [
            'title' => 'Paket',
            'outlet' => $outlet,
        ]);
    }

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
            'message' => 'Packets successfully updated!'
        ], Response::HTTP_OK);
    }
}
