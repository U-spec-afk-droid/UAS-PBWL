<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    /**
     * Halaman form booking ruangan
     */
    public function create()
    {
        // ambil ruangan dari tabel "ruangan"
        $ruangans = Ruangan::whereIn('status', ['kosong', 'digunakan'])->get();
        return view('user.bookingclass', compact('ruangans'));
    }

    /**
     * Simpan booking ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal'        => 'required|date',
            'nama_kegiatan'  => 'required',
            'jumlah_peserta' => 'required|integer',
            // perbaikan: tabel = ruangan
            'ruangan_id'     => 'required|exists:ruangan,id',
            'jam_mulai'      => 'required',
            'jam_selesai'    => 'required|after:jam_mulai',
            'keterangan'     => 'nullable'
        ]);

        Booking::create([
            'user_id'        => auth()->id(),
            'ruangan_id'     => $request->ruangan_id,
            'nama_peminjam'  => auth()->user()->name,
            'nama_kegiatan'  => $request->nama_kegiatan,
            'jumlah_peserta' => $request->jumlah_peserta,
            'tanggal'        => $request->tanggal,
            'jam_mulai'      => $request->jam_mulai,
            'jam_selesai'    => $request->jam_selesai,
            'keterangan'     => $request->keterangan,
            'status'         => 'pending',
        ]);

        return redirect()
            ->route('user.booking.riwayat')   // perbaikan: gunakan nama route yang benar
            ->with('success', 'Booking berhasil diajukan & menunggu persetujuan admin');
    }

    /**
     * Halaman Riwayat Booking User
     */
    public function riwayat()
    {
        $userId = auth()->id();

        $bookings = Booking::where('user_id', $userId)
                            ->with('ruangan')
                            ->latest()
                            ->get();

        $totalBookings     = $bookings->count();
        $pendingBookings   = $bookings->where('status', 'pending')->count();
        $acceptedBookings  = $bookings->where('status', 'diterima')->count();
        $completedBookings = $bookings->where('status', 'selesai')->count();

        return view('user.riwayatbooking', compact(
            'bookings',
            'totalBookings',
            'pendingBookings',
            'acceptedBookings',
            'completedBookings'
        ));
    }

    /**
     * Batalkan booking
     */
    public function cancel($id)
    {
        $booking = Booking::where('id', $id)
                           ->where('user_id', auth()->id())
                           ->firstOrFail();

        if ($booking->status === 'pending') {
            $booking->delete();
            return back()->with('success', 'Booking berhasil dibatalkan.');
        }

        return back()->with('error', 'Booking tidak bisa dibatalkan.');
    }
}