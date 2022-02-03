<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OutletController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

            Route::prefix('/admin')->group(function () {
                Route::redirect('/', '/admin/house');
                Route::get('/house', [AdminController::class, 'index'])->name('admin.house');
                Route::resource('/outlet', OutletController::class)->except(['show']);
    });

    Route::prefix('/outlet/{outlet}')->group(function () {
        Route::get('/', [OutletController::class, 'home'])->name('outlet.home');
        Route::get('/member/data', [MemberController::class, 'data'])->name('member.data');
        Route::apiResource('/member', MemberController::class);
    });
