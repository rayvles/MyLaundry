<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Models\Outlet;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Membuat Function Untuk Menampilkan Halaman Users
     *
     * 
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
    * Membuat Function Untuk Mengdownload File Excel yang akan diexport
    *
    */
    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    /**
    * Membuat Function Untuk Mengimport FIle Excel yang telah dibuat
    * @param Request $request
    */
    public function import(Request $request) 
    {
        $import = new UsersImport();
        $import->setOutletId($request->id_outlet);
        Excel::import($import, request()->file('file'));
        return redirect('/users')->with('success', 'All good!');
    }

    /**
     * Menampilkan Data Users.
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
     * Menampilkan Datatable Users dan Menambahkan column.
     *
     */
    public function datatable()
    {
        $users = User::with('outlet')->get();

        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('actions', function ($user) {
                $editBtn = '<button onclick="editHandler(' . "'" . route('users.update', $user->id) . "'" . ')" class="btn btn-success mx-1 mb-1">
                    <i class="fas fa-edit mr-1"></i>
                    <span>Edit user</span>
                </button>';
                $deleteBtn = '<button onclick="deleteHandler(' . "'" . route('users.destroy', $user->id) . "'" . ')" class="btn btn-danger mx-1 mb-1">
                    <i class="fas fa-trash mr-1"></i>
                    <span>Delete User</span>
                </button>';
                return $editBtn . $deleteBtn;
            })->rawColumns(['actions'])->make(true);
    }

    /**
     * Membuat Function Create Users.
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
     * Menampilkan Data Users.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json([
            'message' => 'Data user',
            'user' => $user
        ], Response::HTTP_OK);
    }

    /**
     * Membuat Function Untuk Mengupdate Data Users.
     *
     * @param  \App\Models\User  $user
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,owner,kasir',
            'id_outlet' => 'required|exists:tb_outlet,id',
        ]);

        $pasload = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'id_outlet' => $request->id_outlet,
        ];

        if ($request->has('password') && $request->password != '') {
            $request->validate([
                'password' => 'required|min:5|confirmed',
                'password_confirmation' => 'required',
            ]);
            $pasload['password'] = bcrypt($request->password);
        }

        $user->update($pasload);

        return response()->json([
            'message' => 'User successfully updated!'
        ], Response::HTTP_OK);
    }

    /**
     * Membuat Function Untuk Menghapus Data Users.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->delete()) {
            return response()->json([
                'message' => 'User successfully Deleted!'
            ], Response::HTTP_OK);
        };

        return response()->json([
            'message' => 'Something Went Wrong!'
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    
}
