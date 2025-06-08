<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\BarangController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('landing.home');
})->name('landing.home');

Route::get('backend/beranda', function() {
    return view('landing.home');
})->name('backend.beranda')->middleware('auth');

Route::get('backend/login', [LoginController::class, 'loginBackend'])->name('login'); 
Route::post('backend/login', [LoginController::class, 'authenticateBackend']); 
Route::get('backend/register', [LoginController::class, 'registerBackend'])->name('backend.register');
Route::post('backend/register', [LoginController::class, 'registerBackend']);
Route::post('backend/logout', [LoginController::class, 'logoutBackend'])->name('backend.logout');

Route::resource('backend/user', UserController::class, ['as' => 'backend'])->middleware('auth');
Route::resource('backend/barang', BarangController::class, ['as' => 'backend'])->middleware('auth');
Route::get('backend/barang/{barang}/add-stock', [\App\Http\Controllers\BarangController::class, 'showAddStockForm'])->name('backend.barang.add-stock-form')->middleware('auth');
Route::post('backend/barang/{barang}/add-stock', [\App\Http\Controllers\BarangController::class, 'addStock'])->name('backend.barang.add-stock')->middleware('auth');

Route::get('backend/transaksi', [\App\Http\Controllers\TransaksiController::class, 'index'])->name('backend.transaksi.index')->middleware('auth');
Route::post('backend/transaksi', [\App\Http\Controllers\TransaksiController::class, 'store'])->name('backend.transaksi.store')->middleware('auth');
Route::get('backend/riwayat-transaksi', [\App\Http\Controllers\TransaksiController::class, 'history'])->name('backend.transaksi.history')->middleware('auth');
Route::get('backend/riwayat-transaksi/{transaksi}', [\App\Http\Controllers\TransaksiController::class, 'show'])->name('backend.transaksi.show')->middleware('auth');

