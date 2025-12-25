<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    protected $table = 'ruangan';   // ← penting
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'kode_ruangan',
        'nama_ruangan',
        'kapasitas',
        'status'
    ];
}
