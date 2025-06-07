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

Route::get('/', function () {
    return view('welcome');
});


Route::resource('backend/user', UserController::class, ['as' => 'backend'])->middleware('auth');
Route::resource('backend/barang', BarangController::class, ['as' => 'backend'])->middleware('auth');