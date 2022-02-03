<?php

namespace App\Http\Controllers;

use App\Models\member;
use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;

class MemberController extends Controller
{
    public function index(Outlet $outlet)
    {
        return view('outlet.member', [
            'title' => 'Member',
            'outlet' => $outlet,
        ]);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param \App\Models\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Outlet $outlet)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'telepon' => 'required|max:15'
        ]);

        Member::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'telepon' => $request->telepon,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Members successfully added!'
        ], Response::HTTP_OK);
    }
}
