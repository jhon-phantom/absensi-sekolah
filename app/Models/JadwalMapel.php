<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalMapel extends Model
{
    protected $fillable = [
        'guru_id',
        'kelas_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'mapel',
    ];
}
