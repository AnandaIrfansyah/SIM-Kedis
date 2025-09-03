<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenKendaraan extends Model
{
    protected $table = 'dokumen_kendaraans';

    protected $fillable = [
        'kendaraan_id',
        'jenis_dokumen',
        'file_dokumen',
    ];
}
