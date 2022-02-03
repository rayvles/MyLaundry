<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    // Halaman Per Outlet
    public function home(Outlet $outlet)
    {
        return view('outlet.home', [
            'outlet' => $outlet
        ]);
    }

    // Halaman Outlet
    public function index()
    {
        $outlet = Outlet::all();
        return view('admin.outlet.index', [
            'title' => 'Outlet',
            'data_outlet' => $outlet,
        ]);

    }

    // Outlet Create
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

    // Outlet Update
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

    // Outlet Delete
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
