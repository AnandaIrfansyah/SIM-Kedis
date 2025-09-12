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

    public function getNamaAttribute()
    {
        return $this->user ? $this->user->name : null;
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kepemilikanKendaraans()
    {
        return $this->hasMany(KepemilikanKendaraan::class);
    }

    public function kendaraans()
    {
        return $this->belongsToMany(Kendaraan::class, 'kepemilikan_kendaraans')
            ->withPivot(['tanggal_mulai', 'tanggal_selesai', 'status'])
            ->withTimestamps();
    }

    public function pemeliharaans()
    {
        return $this->hasMany(Pemeliharaan::class, 'asn_id');
    }
}
