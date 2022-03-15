<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Outlet;
use App\Models\PenjemputanLaundry;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PenjemputanLaundryController extends Controller
{
    public function index() {
        $member = Member::get();
        $penjemputanlaundry = PenjemputanLaundry::get();
        return view('admin.penjemputanlaundry', [
            'title' => 'Penjemputanlaundry',
            'members' => $member,
            'data_penjemputanlaundry' => $penjemputanlaundry,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_member' => 'required|exists:tb_member,id',
            'petugas_penjemput' => 'required|',
        ]);

        PenjemputanLaundry::create([
            'id_member' => $request->id_member,
            'petugas_penjemput' => $request->petugas_penjemput,
        ]);

        

        return redirect()->route('penjemputanlaundry.index');
    }


    public function update(Request $request, PenjemputanLaundry $penjemputanlaundry)
    {
        $request->validate([
            'id_member' => 'required|exists:tb_member,id',
            'petugas_penjemput' => 'required',
        ]);

        $penjemputanlaundry->update([
            'id_member' => $request->id_member,
            'petugas_penjemput' => $request->petugas_penjemput,
        ]);

        return redirect()->route('penjemputanlaundry.index');
    }
    
    public function destroy(PenjemputanLaundry $penjemputanlaundry)
    {
        if ($penjemputanlaundry->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Penjemputan Laundry successfully removed!'
            ], Response::HTTP_OK);
        };

        return response()->json([
            'message' => 'Errors occurred'
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
    
}
