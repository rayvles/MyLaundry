<?php

namespace App\Http\Controllers;

use App\Exports\MemberExport;
use App\Models\Member;
use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

class MemberController extends Controller
{
     /**
     * Membuat Function Untuk Menampilkan Halaman Member
     *
     * @param  \App\Models\Outlet  $outlet
     */
    public function index(Outlet $outlet, Member $member)
    {
        Gate::authorize('register-member');
        return view('outlet.member', [
            'title' => 'Member',
            'outlet' => $outlet,
            'members' => $member
        ]);
    }

     /**
     * Membuat Function Untuk Menampilkan Data Member Pada Datatable
     *
     * @param  \App\Models\Outlet  $outlet
     */
    public function data(Outlet $outlet)
    {
        $member = Member::all();
        return DataTables::of($member)
            ->addIndexColumn()
            ->addColumn('action', function ($member) use ($outlet) {
                $whatsappBtn = '<a href="https://wa.me/' . $member->telepon . '" target="_blank" class="btn btn-success">
                    <i class="fab fa-whatsapp mr-1"></i>
                    <span>Whatsapp</span>
                </a>';
                $menuBtn = '<div class="dropdown d-inline">
                    <button class="btn btn-primary" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a onclick="editHandler(' . "'" . route('member.update', [$outlet->id, $member->id]) . "'" . ')" class="dropdown-item">
                            <i class="fas fa-edit"></i>
                            <span>Edit</span>
                        </a>
                        <button onclick="deleteHandler(' . "'" . route('member.destroy', [$outlet->id, $member->id]) . "'" . ')" class="dropdown-item" id="deleteBtn">
                            <i class="fas fa-trash"></i>
                            <span>Delete</span>
                        </button>
                    </div>
                </div>';
                return $whatsappBtn . $menuBtn;
            })->rawColumns(['action'])->make(true);
    }

     /**
     * Membuat Function Untuk Menambahkan Data Member
     *
     * @param  \App\Models\Outlet  $outlet
     * @param  \Illuminate\Http\Request  $request
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

     /**
     * Membuat Function Untuk Menampilkan data member
     *
     * @param  \App\Models\Outlet  $outlet
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Outlet $outlet, Member $member)
    {
        return response()->json([
            'success' => true,
            'message' => 'Data member',
            'member' => $member
        ], Response::HTTP_OK);
    }

     /**
     * Membuat Function Untuk Mengupdate Data Member
     *
     * @param  \App\Models\Outlet  $outlet
     * @param  \App\Models\Member  $paket
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Outlet $outlet, Member $member)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'telepon' => 'required|max:15'
        ]);

        $member->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'telepon' => $request->telepon,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Member successfully updated!'
        ], Response::HTTP_OK);
    }

     /**
     * Membuat Function Untuk Menghapus Data Member
     *
     * @param  \App\Models\Outlet  $outlet
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outlet $outlet, Member $member)
    {
        if ($member->delete()) {
            return response()->json([
                'message' => 'Member successfully deleted!'
            ], Response::HTTP_OK);
        };

        return response()->json([
            'message' => 'Error'
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function exportExcel()
    {
        return (new MemberExport)->download('Data-Member-' . date('d-m-Y') . '.xlsx');
    }
}
