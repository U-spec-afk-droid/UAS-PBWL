<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

// Redirect root ke login
Route::get('/', function () {
    return redirect('/login');
});

// Routes yang membutuhkan auth
Route::middleware(['auth'])->group(function () {
    
    // Dashboard / Home
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    // Informasi Kelas
    Route::get('/infokelas', [RuanganController::class, 'index'])->name('infokelas');
    
    // Booking Kelas
    Route::get('/bookingclass', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    
    // Riwayat Booking
    Route::get('/riwayatbooking', [BookingController::class, 'riwayat'])->name('booking.riwayat');
    Route::delete('/booking/{id}/cancel', [BookingController::class, 'cancel'])->name('booking.cancel');
    
    // Admin Routes (opsional)
    Route::middleware(['admin'])->group(function () {
        Route::post('/booking/{id}/approve', [BookingController::class, 'approve'])->name('booking.approve');
        Route::post('/booking/{id}/reject', [BookingController::class, 'reject'])->name('booking.reject');
        Route::post('/booking/{id}/complete', [BookingController::class, 'complete'])->name('booking.complete');
    });
});

// Include auth routes
require __DIR__.'/auth.php';