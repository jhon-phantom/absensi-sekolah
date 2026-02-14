<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Guru extends Model
{
    protected $fillable = [
        'nbm',
        'nama',
        'mapel',
        'user_id',
        'is_piket',
        'qr_token',
    ];

    protected static function booted()
    {
        static::creating(function ($guru) {
            $guru->qr_token = Str::uuid();
        });

        static::deleting(function ($guru) {
            if ($guru->user) {
                $guru->user->delete();
            }
        });
    }



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mapels()
    {
        return $this->belongsToMany(Mapel::class, 'guru_mapel');
    }
    public function jadwals()
    {
        return $this->hasMany(JadwalMapel::class);
    }

    public function absensi()
    {
        return $this->hasMany(AbsensiGuru::class);
    }
}
