<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemeliharaan extends Model
{
    protected $table = 'pemeliharaans';

    protected $fillable = [
        'kendaraan_id',
        'tanggal_pemeliharaan',
        'jenis_pemeliharaan',
        'biaya',
        'bengkel',
        'keterangan',
    ];
}
