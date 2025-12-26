<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // ================= DASHBOARD ADMIN =================
    public function dashboard()
    {
        return view('admin.dashboard', [
            'total'     => Booking::count(),
            'pending'   => Booking::where('status', 'pending')->count(),
            'accepted'  => Booking::where('status', 'diterima')->count(),
            'completed' => Booking::where('status', 'selesai')->count(),
            'bookings'  => Booking::with('ruangan')->latest()->get()
        ]);
    }

    // ================= BOOKING ACTION =================
    public function approveBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'diterima']);
        $booking->ruangan->update(['status' => 'dibooking']);

        return back()->with('success', 'Booking diterima.');
    }

    public function rejectBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'ditolak']);
        $booking->ruangan->update(['status' => 'kosong']);

        return back()->with('success', 'Booking ditolak.');
    }

    public function completeBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'selesai']);
        $booking->ruangan->update(['status' => 'kosong']);

        return back()->with('success', 'Kegiatan selesai.');
    }

    // ✅ DELETE BOOKING (TAMBAHAN)
    public function deleteBooking($id)
    {
        $booking = Booking::findOrFail($id);

        // kembalikan status ruangan jika ada
        if ($booking->ruangan) {
            $booking->ruangan->update(['status' => 'kosong']);
        }

        $booking->delete();

        return back()->with('success', 'Booking berhasil dihapus.');
    }

    // ================= CRUD RUANGAN =================
    public function ruanganIndex()
    {
        return view('admin.ruangan', [
            'ruangans' => Ruangan::all()
        ]);
    }

    public function storeRuangan(Request $request)
    {
        $request->validate([
            'kode_ruangan' => 'required',
            'nama_ruangan' => 'required',
            'kapasitas'    => 'required|integer',
            'status'       => 'required'
        ]);

        Ruangan::create($request->all());

        return back()->with('success', 'Ruangan berhasil ditambahkan!');
    }

    public function updateRuangan(Request $request, $id)
    {
        $ruangan = Ruangan::findOrFail($id);
        $ruangan->update($request->all());

        return back()->with('success', 'Data ruangan berhasil diperbarui!');
    }

    public function deleteRuangan($id)
    {
        Ruangan::findOrFail($id)->delete();

        return back()->with('success', 'Ruangan berhasil dihapus!');
    }
}
