<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbsensiGuru extends Model
{
    protected $table = 'absensi_guru';

    protected $fillable = [
        'guru_id',
        'tanggal',
        'jam_masuk',
        'jam_pulang',
        'status',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}
