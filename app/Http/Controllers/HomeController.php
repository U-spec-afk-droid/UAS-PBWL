<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 👇 STEP 2 QUERY AMBIL DATA RUANGAN
        $ruangan = Ruangan::orderBy('kode_ruangan')->get();

        // kirim ke view
        return view('home', compact('ruangan'));
    }
}
