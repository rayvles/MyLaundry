<?php

namespace App\Http\Controllers;



use App\Models\Baranginventaris;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Response;


class BaranginventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
           
        return view('baranginventaris.index', [
            'title' => 'Inventory Items',
        ]);

        
    }


    /**
     * Return all users data.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $baranginventaris = Baranginventaris::all();

        return response()->json([
            'message' => 'Data baranginventaris',
            'baranginventaris' => $baranginventaris,
        ]);
    }

    /**
     * Return data for DataTables.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatable()
    {
        $baranginventaris = Baranginventaris::all();

        return DataTables::of($baranginventaris)
            ->addIndexColumn()
            ->addColumn('actions', function ($baranginven) {
                $editBtn = '<button onclick="editHandler(' . "'" . route('baranginventaris.update', $baranginven->id) . "'" . ')" class="btn btn-success mx-1 mb-1">
                    <i class="fas fa-edit mr-1"></i>
                    <span>Edit baranginventaris</span>
                </button>';
                $deleteBtn = '<button onclick="deleteHandler(' . "'" . route('baranginventaris.destroy', $baranginven->id) . "'" . ')" class="btn btn-danger mx-1 mb-1">
                    <i class="fas fa-trash mr-1"></i>
                    <span>Delete User</span>
                </button>';
                return $editBtn . $deleteBtn;
            })->rawColumns(['actions'])->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'merk_barang' => 'required',
            'qty' => 'required',
            'kondisi' => 'required|in:layak_pakai,rusak_ringan,rusak_berat',
            'tanggal_pengadaan' => 'required',
            
        ]);

        Baranginventaris::create([
            'nama_barang' => $request->nama_barang,
            'merk_barang' => $request->merk_barang,
            'qty' => $request->qty,
            'kondisi' => $request->kondisi,
            'tanggal_pengadaan' => $request->tanggal_pengadaan,

            
            
        ]);

        

        return response()->json([
            'message' => 'Inventory Items successfully added!'
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $baranginventaris
     * @return \Illuminate\Http\Response
     */
    public function show(Baranginventaris $baranginven)
    {
        return response()->json([
            'message' => 'Data baranginven',
            'baranginven' => $baranginven
        ], Response::HTTP_OK);
    }

    // public function update(Request $request, User $user)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email|unique:users,email,' . $user->id,
    //         'role' => 'required|in:admin,owner,kasir',
    //         'id_outlet' => 'required|exists:tb_outlet,id',
    //     ]);

    //     $pasload = [
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'role' => $request->role,
    //         'id_outlet' => $request->id_outlet,
    //     ];

    //     if ($request->has('password') && $request->password != '') {
    //         $request->validate([
    //             'password' => 'required|min:5|confirmed',
    //             'password_confirmation' => 'required',
    //         ]);
    //         $pasload['password'] = bcrypt($request->password);
    //     }

    //     $user->update($pasload);

    //     return response()->json([
    //         'message' => 'User successfully updated!'
    //     ], Response::HTTP_OK);
    // }

    // public function destroy(User $user)
    // {
    //     if ($user->delete()) {
    //         return response()->json([
    //             'message' => 'User successfully Deleted!'
    //         ], Response::HTTP_OK);
    //     };

    //     return response()->json([
    //         'message' => 'Something Went Wrong!'
    //     ], Response::HTTP_INTERNAL_SERVER_ERROR);
    // }

    
}
