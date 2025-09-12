<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bengkel extends Model
{
    protected $fillable = [
        'nama',
        'alamat',
    ];

    public function pemeliharaans()
    {
        return $this->hasMany(Pemeliharaan::class);
    }
}
