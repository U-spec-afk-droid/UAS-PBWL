<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('bookings')) {
            Schema::create('bookings', function (Blueprint $table) {
                $table->id();
                $table->foreignId('ruangan_id')->constrained()->onDelete('cascade');
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->string('nama_peminjam');
                $table->string('nama_kegiatan');
                $table->date('tanggal');
                $table->time('jam_mulai');
                $table->time('jam_selesai');
                $table->integer('jumlah_peserta');
                $table->text('keterangan')->nullable();
                $table->enum('status', ['pending', 'diterima', 'ditolak', 'dibatalkan', 'selesai'])
                      ->default('pending');
                $table->timestamps();

                $table->index(['tanggal', 'ruangan_id']);
                $table->index(['user_id', 'status']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
}