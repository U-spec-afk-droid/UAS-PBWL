<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index()
    {
        $ruangan = Ruangan::all();
        return view('user.infokelas', compact('ruangan'));
    }

    // === SIMPAN DATA ===
    public function store(Request $request)
    {
        $request->validate([
            'kode_ruangan' => 'required',
            'nama_ruangan' => 'required',
            'kapasitas'    => 'required|integer',
            'status'       => 'required'
        ]);

        Ruangan::create([
            'kode_ruangan' => $request->kode_ruangan,
            'nama_ruangan' => $request->nama_ruangan,
            'kapasitas'    => $request->kapasitas,
            'status'       => $request->status,
        ]);

        return redirect()->back()->with('success', 'Data ruangan berhasil disimpan!');
    }
}
