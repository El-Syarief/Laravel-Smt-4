<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\berandaController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('landing.home');
})->name('landing.home');

Route::get('backend/beranda', [BerandaController::class, 'berandaBackend']) -> name('backend.beranda');

Route::get('backend/login', [LoginController::class, 'loginBackend'])->name('backend.login'); 
Route::post('backend/login', [LoginController::class, 'authenticateBackend'])->name('backend.login'); 
Route::get('backend/register', [LoginController::class, 'registerBackend'])->name('backend.register');
Route::post('backend/register', [LoginController::class, 'registerBackend'])->name('backend.register');
Route::post('backend/logout', [LoginController::class, 'logoutBackend'])->name('backend.logout');

Route::resource('backend/user', UserController::class, ['as' => 'backend'])->middleware('auth');
Route::resource('backend/barang', BarangController::class, ['as' => 'backend'])->middleware('auth');