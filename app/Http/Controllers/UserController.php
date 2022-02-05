<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index()
    {
        Gate::authorize('manage-user');
        $outlet = Outlet::all();
        return view('admin.users', [
            'dataOutlet' => $outlet,
        ]);
    }
}
