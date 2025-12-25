<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\UpdateRoomStatus; // ← Tambahkan ini

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        // daftar alias middleware
        $middleware->alias([
            'role' => App\Http\Middleware\RoleMiddleware::class,
        ]);

    })

    // ================== ⬇️ Bagian Penjadwalan Otomatis ⬇️ ==================
    ->withSchedule(function (Schedule $schedule) {
        // Jalankan setiap 5 menit untuk update status ruangan otomatis
        $schedule->command(UpdateRoomStatus::class)->everyFiveMinutes();
    })
    // ================== ⬆️ Bagian Penjadwalan Otomatis ⬆️ ==================

    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
