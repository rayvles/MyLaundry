<?php

namespace App\Http\Controllers;



use App\Models\Baranginventaris;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Response;


class BaranginventarisController extends Controller
{
    
    public function index()
    {
        $baranginventaris = Baranginventaris::all();
        return view('baranginventaris.index', [
            'title' => 'Inventory Items',
            'bar$baranginventaris' => $baranginventaris,
        ]);

        
    }

    
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

   
    public function show(Baranginventaris $baranginventarisitems)
    {
        return response()->json([
            'success' => true,
            'message' => 'Data baran$baranginventarisitems',
            'baran$baranginventarisitems' => $baranginventarisitems
        ], Response::HTTP_OK);
    }


  
    
   

    
}
