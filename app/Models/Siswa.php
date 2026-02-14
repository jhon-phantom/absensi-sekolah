<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;



class Siswa extends Model
{
    protected $fillable = [
        'nis',
        'nama',
        'kelas_id',
        'jurusan_id',
        'qr_token',
    ];



    protected static function booted()
    {
        static::creating(function ($siswa) {
            $siswa->qr_token = Str::uuid();
        });
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
