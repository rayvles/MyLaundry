<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
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

// Login
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
});


// Authentikasi Logout
Route::middleware('auth')->group(function () {
    Route::redirect('/', '/home');
    Route::get('/home', [HomeController::class, 'home'])->name('home');
    Route::post('/logout', [AuthController::class, 'logout']);


    Route::prefix('/admin')->group(function () {

        // Admin House
        Route::redirect('/', '/admin/house');
        Route::get('/house', [AdminController::class, 'index'])->name('admin.house');

        // Outlet
        Route::post('/outlet/import/excel', [OutletController::class, 'importExcel'])->name('outlet.import.excel');
        Route::get('/outlet/export/excel', [OutletController::class, 'exportExcel'])->name('outlet.export.excel');
        Route::resource('/outlet', OutletController::class)->except(['show']);

        // Users
        Route::get('/users/datatable', [UserController::class, 'datatable'])->name('users.datatable');
        Route::get('/users/export', [UserController::class, 'export'])->name('users.export');
        Route::apiResource('/users', UserController::class);

        // Penjemputan Laundry
        Route::post('/penjemputanlaundry/import/excel', [PenjemputanLaundryController::class, 'importExcel'])->name('penjemputanlaundry.import.excel');
        Route::get('/penjemputanlaundry/export/excel', [PenjemputanLaundryController::class, 'exportExcel'])->name('penjemputanlaundry.export.excel');
        Route::put('/penjemputanlaundry/{penjemputanlaundry}/status', [PenjemputanLaundryController::class, 'updateStatus'])->name('penjemputanlaundry.updateStatus');
        Route::get('/penjemputanlaundry/export/pdf', [PenjemputanLaundryController::class, 'exportPDF'])->name('penjemputanlaundry.export.pdf');
        Route::apiResource('/penjemputanlaundry', PenjemputanLaundryController::class);

        // Barang
        Route::post('/barang/import/excel', [BarangController::class, 'importExcel'])->name('barang.import.excel');
        Route::get('/barang/export/excel', [BarangController::class, 'exportExcel'])->name('barang.export.excel');
        Route::put('/barang/{barang}/status', [BarangController::class, 'updateStatus'])->name('barang.updateStatus');
        Route::apiResource('/barang', BarangController::class);

        // Simulasi
        Route::get('/simulasi', [SimulasiController::class, 'index'])->name('admin.simulasi');
        Route::get('/simulasikedua', [SimulasiController::class, 'indexkedua'])->name('admin.simulasikedua');
        Route::get('/simulasiketiga', [SimulasiController::class, 'indexketiga'])->name('admin.simulasiketiga');
        Route::get('/simulasikeempat', [SimulasiController::class, 'indexkeempat'])->name('admin.simulasikeempat');
        Route::get('/ujikom', [SimulasiController::class, 'ujikom'])->name('admin.ujikom');

        // Barang Inventaris
        Route::resource('/baranginventaris', BaranginventarisController::class);
        Route::get('/baranginventaris/data', [BaranginventarisController::class, 'data'])->name('baranginventaris.data');

    });

    Route::prefix('/outlet/{outlet}')->group(function () {

        // Halaman Per Outlet
        Route::get('/', [OutletController::class, 'home'])->name('outlet.home');

        // Paket
        Route::get('/paket/export/excel', [PaketController::class, 'exportExcel'])->name('paket.export.excel');
        Route::get('/paket/data', [PaketController::class, 'data'])->name('paket.data');
        Route::apiResource('/paket', PaketController::class);
        Route::get('/member/export/excel', [MemberController::class, 'exportExcel'])->name('member.export.excel');
        Route::get('/member/data', [MemberController::class, 'data'])->name('member.data');
        Route::apiResource('/member', MemberController::class);

        // Transaksi
        Route::get('/transaksi/{transaksi}/whatsapp', [TransaksiController::class, 'sendWhatsapp'])->name('transaksi.sendWhatsapp');
        Route::get('/transaksi/{transaksi}/invoice/pdf', [TransaksiController::class, 'invoicePDF'])->name('transaksi.invoicePDF');
        Route::get('/transaksi/{transaksi}/invoice', [TransaksiController::class, 'invoice'])->name('transaksi.invoice');
        Route::put('/transaksi/{transaksi}/payment', [TransaksiController::class, 'updatePayment'])->name('transaksi.updatePayment');
        Route::put('/transaksi/{transaksi}/status', [TransaksiController::class, 'updateStatus'])->name('transaksi.updateStatus');
        Route::get('/transaksi/datatable', [TransaksiController::class, 'datatable'])->name('transaksi.datatable');
        Route::apiResource('/transaksi', TransaksiController::class);

        // Report Transaksi
        Route::get('/report/export/excel', [TransaksiController::class, 'exportExcel'])->name('transaksi.export.excel');
        Route::get('/report/export/pdf', [TransaksiController::class, 'exportPDF'])->name('transaksi.export.pdf');
        Route::get('/report', [TransaksiController::class, 'report'])->name('transaksi.report');
        Route::get('/report/datatable', [TransaksiController::class, 'reportDatatable'])->name('transaksi.reportDatatable');
    });
});
