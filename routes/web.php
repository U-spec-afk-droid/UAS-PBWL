<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Redirect root ke login
Route::get('/', function () {
    return redirect('/login');
});

// ==================== ADMIN AREA ====================
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    // Booking admin
    Route::post('/admin/booking/{id}/approve', [AdminController::class, 'approveBooking'])
        ->name('admin.booking.approve');

    Route::post('/admin/booking/{id}/reject', [AdminController::class, 'rejectBooking'])
        ->name('admin.booking.reject');

    Route::post('/admin/booking/{id}/complete', [AdminController::class, 'completeBooking'])
        ->name('admin.booking.complete');

    // ✅ DELETE BOOKING
    Route::delete('/admin/booking/{id}', [AdminController::class, 'deleteBooking'])
        ->name('admin.booking.delete');

    // Ruangan admin
    Route::get('/admin/ruangan', [AdminController::class, 'ruanganIndex'])
        ->name('admin.ruangan');

    Route::post('/admin/ruangan/store', [AdminController::class, 'storeRuangan'])
        ->name('admin.ruangan.store');

    Route::post('/admin/ruangan/{id}/update', [AdminController::class, 'updateRuangan'])
        ->name('admin.ruangan.update');

    Route::delete('/admin/ruangan/{id}', [AdminController::class, 'deleteRuangan'])
        ->name('admin.ruangan.delete');
});

// ==================== USER AREA ====================
Route::middleware(['auth'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/user/infokelas', [RuanganController::class, 'index'])->name('user.infokelas');

    Route::get('/user/bookingclass', [BookingController::class, 'create'])->name('user.bookingclass');

    Route::post('/user/booking', [BookingController::class, 'store'])->name('user.booking.store');

    Route::get('/user/riwayatbooking', [BookingController::class, 'riwayat'])->name('user.booking.riwayat');

    Route::delete('/user/booking/{id}/cancel', [BookingController::class, 'cancel'])
        ->name('user.booking.cancel');
});

// Auth routes
require __DIR__.'/auth.php';

