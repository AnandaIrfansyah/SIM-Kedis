<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeliharaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kendaraan_id',
        'bengkel_id',
        'nama_bengkel_manual',
        'alamat_bengkel_manual',
        'nomor_nota',
        'tanggal_pemeliharaan',
        'kilometer',
        'uraian',
        'biaya',
        'keterangan',
        'jenis_pemeliharaan',
    ];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }

    public function bengkel()
    {
        return $this->belongsTo(Bengkel::class);
    }
}
