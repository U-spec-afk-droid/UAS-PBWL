<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $table = 'ruangan'; // nama tabel di database

    protected $fillable = [
        'kode_ruangan',
        'nama_ruangan',
        'kapasitas',
        'status'
    ];
}
