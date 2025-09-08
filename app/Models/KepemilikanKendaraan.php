<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KepemilikanKendaraan extends Model
{
    protected $table = 'kepemilikan_kendaraans';

    protected $fillable = [
        'asn_id',
        'kendaraan_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
    ];

    public function asn()
    {
        return $this->belongsTo(Asn::class, 'asn_id');
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraan_id');
    }
}
