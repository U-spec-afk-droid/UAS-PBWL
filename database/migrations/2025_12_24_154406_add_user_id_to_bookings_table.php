<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToBookingsTable extends Migration
{
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Jika belum ada kolom user_id
            if (!Schema::hasColumn('bookings', 'user_id')) {
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            }
            
            // Tambahkan kolom lain yang mungkin belum ada
            $columnsToCheck = [
                'nama_kegiatan',
                'jumlah_peserta',
                'keterangan',
                'status'
            ];
            
            foreach ($columnsToCheck as $column) {
                if (!Schema::hasColumn('bookings', $column)) {
                    switch ($column) {
                        case 'nama_kegiatan':
                            $table->string('nama_kegiatan')->nullable();
                            break;
                        case 'jumlah_peserta':
                            $table->integer('jumlah_peserta')->default(1);
                            break;
                        case 'keterangan':
                            $table->text('keterangan')->nullable();
                            break;
                        case 'status':
                            $table->enum('status', ['pending', 'diterima', 'ditolak', 'dibatalkan', 'selesai'])->default('pending');
                            break;
                    }
                }
            }
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            $table->dropColumn(['nama_kegiatan', 'jumlah_peserta', 'keterangan', 'status']);
        });
    }
}