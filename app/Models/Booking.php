<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'ruangan_id',
        'user_id',
        'nama_peminjam',
        'nama_kegiatan',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'jumlah_peserta',
        'keterangan',
        'status'
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Relasi ke model User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke model Ruangan
     */
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }

    /**
     * Scope untuk booking milik user tertentu
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope untuk booking dengan status tertentu
     */
    public function scopeWithStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Cek apakah booking masih bisa dibatalkan
     */
    public function canBeCancelled()
    {
        return $this->status === 'pending';
    }

    /**
     * Format tanggal untuk tampilan
     */
    public function getFormattedTanggalAttribute()
    {
        return $this->tanggal->format('d F Y');
    }

    /**
     * Format waktu untuk tampilan
     */
    public function getFormattedWaktuAttribute()
    {
        return $this->jam_mulai . ' - ' . $this->jam_selesai;
    }
}