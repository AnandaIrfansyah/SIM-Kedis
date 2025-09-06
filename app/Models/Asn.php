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
        return $this->belongsTo(User::class);
    }

    public function kepemilikanKendaraans()
    {
        return $this->hasMany(KepemilikanKendaraan::class);
    }
}
