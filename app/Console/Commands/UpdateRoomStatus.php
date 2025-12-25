<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use Carbon\Carbon;

class UpdateRoomStatus extends Command
{
    protected $signature = 'statusruangan:update';
    protected $description = 'Update status ruangan otomatis berdasarkan waktu booking';

    public function handle()
    {
        echo "Memeriksa status ruangan...\n";

        $now = Carbon::now();

        $bookings = Booking::where('status', 'diterima')
            ->whereRaw("CONCAT(tanggal, ' ', jam_selesai) < ?", [$now])
            ->get();

        foreach ($bookings as $b) {
            $b->update(['status' => 'selesai']);
            $b->ruangan->update(['status' => 'kosong']);
        }

        echo "Status ruangan diperbarui.\n";
    }
}
