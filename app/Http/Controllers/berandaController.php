<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class berandaController extends Controller
{
    public function berandaBackend()
    {
        return view('backend.beranda');
    }

}
