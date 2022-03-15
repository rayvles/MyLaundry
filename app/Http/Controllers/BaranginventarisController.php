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
        $baranginventaris = Baranginventaris::all();
        return view('baranginventaris.index', [
            'title' => 'Inventory Items',
            'bar$baranginventaris' => $baranginventaris,
        ]);

        
    }

    // Show Datatable Member
    public function data()
    {
        $baranginventaris = Baranginventaris::all();
        return DataTables::of($baranginventaris)
            ->addIndexColumn()
            ->addColumn('action', function ($baranginventarisitems){
                $menuBtn = '<div class="dropdown d-inline">
                    <button class="btn btn-primary" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a onclick="editHandler(' . "'" . route('baranginventaris.update', [$baranginventarisitems->id]) . "'" . ')" class="dropdown-item">
                            <i class="fas fa-edit"></i>
                            <span>Edit</span>
                        </a>
                        <button onclick="deleteHandler(' . "'" . route('baranginventaris.destroy', [$baranginventarisitems->id]) . "'" . ')" class="dropdown-item" id="deleteBtn">
                            <i class="fas fa-trash"></i>
                            <span>Delete</span>
                        </button>
                    </div>
                </div>';
                return $menuBtn;
            })->rawColumns(['action'])->make(true);
    }

    // Show Data Member
    public function show(Baranginventaris $baranginventarisitems)
    {
        return response()->json([
            'success' => true,
            'message' => 'Data baran$baranginventarisitems',
            'baran$baranginventarisitems' => $baranginventarisitems
        ], Response::HTTP_OK);
    }


  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'nama_barang' => 'required',
    //         'merk_barang' => 'required',
    //         'qty' => 'required',
    //         'kondisi' => 'required|in:layak_pakai,rusak_ringan,rusak_berat',
    //         'tanggal_pengadaan' => 'required',
            
    //     ]);

    //     Baranginventaris::create([
    //         'nama_barang' => $request->nama_barang,
    //         'merk_barang' => $request->merk_barang,
    //         'qty' => $request->qty,
    //         'kondisi' => $request->kondisi,
    //         'tanggal_pengadaan' => $request->tanggal_pengadaan,

            
            
    //     ]);
        

    //     return redirect()->route('baranginventaris.index');
    // }

   

    
}
