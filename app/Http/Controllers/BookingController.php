<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request, $id)
{
    // 1️⃣ Cek bentrok waktu
    $bentrok = Booking::where('ruangan_id', $id)
        ->where('tanggal', $request->tanggal)
        ->where(function ($query) use ($request) {
            $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                  ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                  ->orWhere(function ($q) use ($request) {
                      $q->where('jam_mulai', '<=', $request->jam_mulai)
                        ->where('jam_selesai', '>=', $request->jam_selesai);
                  });
        })
        ->exists();

    // 2️⃣ Jika bentrok → tolak
    if ($bentrok) {
        return redirect('/')
            ->with('error', 'Ruangan sudah dibooking pada jam tersebut');
    }

    // 3️⃣ Simpan booking
    Booking::create([
        'ruangan_id'    => $id,
        'nama_peminjam' => $request->nama_peminjam,
        'tanggal'       => $request->tanggal,
        'jam_mulai'     => $request->jam_mulai,
        'jam_selesai'   => $request->jam_selesai,
    ]);

    // 4️⃣ Update status ruangan
    Ruangan::where('id', $id)->update([
        'status' => 'dibooking'
    ]);

    return redirect('/')
        ->with('success', 'Ruangan berhasil dibooking');
}
}

