<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index()
    {
        // Ambil semua data ruangan
        $ruangan = Ruangan::all();

        // Kirim data ke view
        return view('infokelas', compact('ruangan'));
    }
}
