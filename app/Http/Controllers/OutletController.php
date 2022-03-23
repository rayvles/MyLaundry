<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OutletController extends Controller
{
    /**
     * Membuat Function Untuk Menampilkan Halaman Per Outlet
     *
     * @param  \App\Models\Outlet  $outlet
     */
    public function home(Outlet $outlet)
    {
        return view('outlet.home', [
            'outlet' => $outlet
        ]);
    }

    /**
     * Membuat Function Untuk Menampilkan Halaman Outlet
     *
     * @param  \App\Models\Outlet  $outlet
     */
    public function index()
    {
        $outlet = Outlet::where('id', auth()->user()->id_outlet)->get();
        return view('admin.outlet.index', [
            'title' => 'Outlet',
            'data_outlet' => $outlet,
        ]);

    }

    

    /**
     * Membuat Function Untuk Menambahkan Data Outlet
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'telepon' => 'required|max:15',
            'alamat' => 'required'
        ]);

        Outlet::create([
            'nama' => $request->nama,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('outlet.index');
    }

    /**
     * Membuat Function Untuk Mengupdate Data Outlet
     *
     * @param  \App\Models\Outlet  $outlet
     * @param  \Illuminate\Http\Request  $request
     */
    public function update(Request $request, Outlet $outlet)
    {
        $request->validate([
            'nama' => 'required|string',
            'telepon' => 'required|max:15',
            'alamat' => 'required'
        ]);

        $outlet->update([
            'nama' => $request->nama,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('outlet.index');
    }

    /**
     * Membuat Function Untuk Menghapus Data Outlet
     *
     * @param  \App\Models\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
   
    public function destroy(Outlet $outlet)
    {
        if ($outlet->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'outlet successfully removed!'
            ], Response::HTTP_OK);
        };

        return response()->json([
            'message' => 'Errors occurred'
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}