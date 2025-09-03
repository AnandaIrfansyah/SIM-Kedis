<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KepemilikanKendaraan extends Model
{
    protected $fillable = [
        'asn_id',
        'kendaraan_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
    ];

    public function asn()
    {
        return $this->belongsTo(Asn::class);
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }
}
