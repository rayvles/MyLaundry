<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outlet = Outlet::get();

        return view('users.index', [
            'title' => 'Manage User',
            'outlets' => $outlet,
        ]);

        
    }

    /**
     * Return all users data.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $users = User::all();

        return response()->json([
            'message' => 'Data outlet',
            'users' => $users,
        ]);
    }

    /**
     * Return data for DataTables.
     *
     * @return \Illuminate\Http\Response
     */
    // public function datatable()
    // {
    //     $users = User::with('outlet')->get();

    //     return DataTables::of($users)
    //         ->addIndexColumn()
    //         ->addColumn('actions', function ($user) {
    //             $editBtn = '<button onclick="editHandler(' . "'" . route('users.update', $user->id) . "'" . ')" class="btn btn-warning mx-1 mb-1">
    //                 <i class="fas fa-edit mr-1"></i>
    //                 <span>Edit user</span>
    //             </button>';
    //             $deleteBtn = '<button onclick="deleteHandler(' . "'" . route('users.destroy', $user->id) . "'" . ')" class="btn btn-danger mx-1 mb-1">
    //                 <i class="fas fa-trash mr-1"></i>
    //                 <span>Hapus user</span>
    //             </button>';
    //             return $editBtn . $deleteBtn;
    //         })->rawColumns(['actions'])->make(true);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|confirmed',
            'password_confirmation' => 'required',
            'role' => 'required|in:admin,owner,kasir',
            'id_outlet' => 'required|exists:tb_outlet,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password),
            'id_outlet' => $request->id_outlet,
        ]);

        

        return response()->json([
            'message' => 'Register successfully added!'
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    // public function show(User $user)
    // {
    //     return response()->json([
    //         'message' => 'Data user',
    //         'user' => $user
    //     ], Response::HTTP_OK);
    // }

    
}
