<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\BarangController;
// use App\Http\Controllers\berandaController; // Tidak kita perlukan lagi untuk rute ini

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute untuk landing page (sebelum login)
Route::get('/', function () {
    return view('landing.home');
})->name('landing.home');

// Rute untuk dasbor (setelah login), sekarang mengarah ke file view yang sama
Route::get('backend/beranda', function() {
    return view('landing.home');
})->name('backend.beranda')->middleware('auth');


// Rute untuk otentikasi
Route::get('backend/login', [LoginController::class, 'loginBackend'])->name('login'); 
Route::post('backend/login', [LoginController::class, 'authenticateBackend']); 
Route::get('backend/register', [LoginController::class, 'registerBackend'])->name('backend.register');
Route::post('backend/register', [LoginController::class, 'registerBackend']);
Route::post('backend/logout', [LoginController::class, 'logoutBackend'])->name('backend.logout');

// Rute untuk resource lainnya (tetap butuh controller masing-masing)
Route::resource('backend/user', UserController::class, ['as' => 'backend'])->middleware('auth');
Route::resource('backend/barang', BarangController::class, ['as' => 'backend'])->middleware('auth');