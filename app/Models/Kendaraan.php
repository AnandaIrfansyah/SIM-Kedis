<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $table = 'kendaraans';

    protected $fillable = [
        'kode_qr',
        'plat_nomor',
        'jenis',
        'merk',
        'warna',
        'tahun',
        'nomor_rangka',
        'nomor_mesin',
        'nomor_bpkb',
        'pemegang',
        'unit_kerja',
        'jatuh_tempo_pajak_tahunan',
        'jatuh_tempo_stnk',
        'status',
        'foto_kendaraan',
    ];
}
