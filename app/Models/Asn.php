<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asn extends Model
{
    protected $table = 'asns';

    protected $fillable = [
        'user_id',
        'nip',
        'jabatan',
        'unit_kerja',
        'no_hp',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kepemilikanKendaraans()
    {
        return $this->hasMany(KepemilikanKendaraan::class, 'asn_id');
    }

    public function pemeliharaans()
    {
        return $this->hasMany(Pemeliharaan::class, 'asn_id');
    }
}
