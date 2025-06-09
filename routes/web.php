<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\LaporanController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('landing.home');
})->name('landing.home');

Route::get('backend/beranda', [\App\Http\Controllers\BerandaController::class, 'berandaBackend'])->name('backend.beranda')->middleware('auth');

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

Route::get('backend/laporan-laba', [LaporanController::class, 'index'])->name('backend.laporan.index')->middleware('auth');
Route::get('backend/laporan-laba/input-beban', [LaporanController::class, 'showBebanForm'])->name('backend.laporan.beban.form')->middleware('auth');
Route::post('backend/laporan-laba/input-beban', [LaporanController::class, 'storeBeban'])->name('backend.laporan.beban.store')->middleware('auth');
Route::get('backend/laporan-laba/beban/{pengeluaran}/edit', [LaporanController::class, 'editBeban'])->name('backend.laporan.beban.edit')->middleware('auth');
Route::put('backend/laporan-laba/beban/{pengeluaran}', [LaporanController::class, 'updateBeban'])->name('backend.laporan.beban.update')->middleware('auth');
Route::delete('backend/laporan-laba/beban/{pengeluaran}', [LaporanController::class, 'destroyBeban'])->name('backend.laporan.beban.destroy')->middleware('auth');
Route::get('backend/laporan-laba/{tahun}/{bulan}', [LaporanController::class, 'DetailLaporan'])->name('backend.laporan.show.monthly')->middleware('auth');
Route::get('backend/laporan-laba/{tahun}/{bulan}/download', [LaporanController::class, 'downloadPDF'])->name('backend.laporan.download')->middleware('auth');
