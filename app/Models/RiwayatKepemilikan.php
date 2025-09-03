<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatKepemilikan extends Model
{
    protected $table = 'riwayat_kepemilikans';

    protected $fillable = [
        'kendaraan_id',
        'pegawai_id',
        'tanggal_mulai',
        'tanggal_selesai',
    ];
}
