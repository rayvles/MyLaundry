<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BaranginventarisController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PenjemputanLaundryController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SimulasiController;
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

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
});

    
Route::middleware('auth')->group(function () {
    Route::redirect('/', '/home');
    Route::get('/home', [HomeController::class, 'home'])->name('home');
    Route::post('/logout', [AuthController::class, 'logout']);
    

    Route::prefix('/admin')->group(function () {
        Route::redirect('/', '/admin/house');
        Route::get('/house', [AdminController::class, 'index'])->name('admin.house');
        Route::resource('/outlet', OutletController::class)->except(['show']);
        Route::get('/users/datatable', [UserController::class, 'datatable'])->name('users.datatable');
        Route::get('/users/export', [UserController::class, 'export'])->name('users.export');
        Route::apiResource('/users', UserController::class);
        Route::post('/penjemputanlaundry/import/excel', [PenjemputanLaundryController::class, 'importExcel'])->name('penjemputanlaundry.import.excel');
        Route::get('/penjemputanlaundry/export/excel', [PenjemputanLaundryController::class, 'exportExcel'])->name('penjemputanlaundry.export.excel');
        Route::put('/penjemputanlaundry/{penjemputanlaundry}/status', [PenjemputanLaundryController::class, 'updateStatus'])->name('penjemputanlaundry.updateStatus');
        Route::get('/penjemputanlaundry/export/pdf', [PenjemputanLaundryController::class, 'exportPDF'])->name('penjemputanlaundry.export.pdf');
        Route::apiResource('/penjemputanlaundry', PenjemputanLaundryController::class);
        Route::get('/simulasi', [SimulasiController::class, 'index'])->name('admin.simulasi'); 
        Route::get('/simulasikedua', [SimulasiController::class, 'indexkedua'])->name('admin.simulasikedua');
        Route::get('/simulasiketiga', [SimulasiController::class, 'indexketiga'])->name('admin.simulasiketiga');
        Route::resource('/baranginventaris', BaranginventarisController::class);
        Route::get('/baranginventaris/data', [BaranginventarisController::class, 'data'])->name('baranginventaris.data');
        
    });

    Route::prefix('/outlet/{outlet}')->group(function () {
        Route::get('/', [OutletController::class, 'home'])->name('outlet.home');
        Route::get('/paket/data', [PaketController::class, 'data'])->name('paket.data');
        Route::apiResource('/paket', PaketController::class);
        Route::get('/member/data', [MemberController::class, 'data'])->name('member.data');
        Route::apiResource('/member', MemberController::class);
        Route::get('/transaksi/datatable', [TransaksiController::class, 'datatable'])->name('transaksi.datatable');
        Route::apiResource('/transaksi', TransaksiController::class);
        Route::get('/report', [TransaksiController::class, 'report'])->name('transaksi.report');
        Route::get('/report/datatable', [TransaksiController::class, 'reportDatatable'])->name('transaksi.reportDatatable');
    });
});