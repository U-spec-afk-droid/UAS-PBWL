<?php

namespace App\Http\Controllers;

use App\Models\Booking;

class HomeController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // data riwayat booking user (yang sudah Anda punya)
        $bookings = Booking::where('user_id', $userId)->latest()->get();

        // tambahan untuk dashboard user agar tidak error
        $total     = $bookings->count();
        $pending   = $bookings->where('status', 'pending')->count();
        $accepted  = $bookings->where('status', 'diterima')->count();
        $completed = $bookings->where('status', 'selesai')->count();

        return view('user.dashboard', [
            'bookings'  => $bookings,
            'total'     => $total,
            'pending'   => $pending,
            'accepted'  => $accepted,
            'completed' => $completed,
        ]);
    }
}
