<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $table = 'kendaraans';

    protected $fillable = [
        'merk',
        'tipe',
        'no_polisi',
        'no_rangka',
        'no_mesin',
        'tahun',
        'jenis',
        'jatuh_tempo_pajak',
        'jatuh_tempo_stnk',
        'foto',
        'qr_code',
        'status',
    ];

    public function currentKepemilikan()
    {
        return $this->hasOne(KepemilikanKendaraan::class)->whereNull('tanggal_selesai');
    }

    public function pemeliharaans()
    {
        return $this->hasMany(Pemeliharaan::class, 'kendaraan_id');
    }

    public function kepemilikanKendaraans()
    {
        return $this->hasMany(KepemilikanKendaraan::class, 'kendaraan_id');
    }
}
