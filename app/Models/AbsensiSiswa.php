<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbsensiSiswa extends Model
{
    protected $fillable = [
        'siswa_id',
        'tanggal',
        'jam_masuk',
        'status',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
