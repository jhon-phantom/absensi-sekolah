<?php

namespace App\Imports;

namespace App\Imports;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Jurusan;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $kelas = Kelas::where('nama', trim($row['kelas']))->first();
        $jurusan = Jurusan::where('nama', trim($row['jurusan']))->first();

        if (! $kelas || ! $jurusan) {
            return null;
        }

        return new Siswa([
            'nis'        => $row['nis'],
            'nama'       => $row['nama'],
            'kelas_id'   => $kelas->id,
            'jurusan_id' => $jurusan->id,
            'qr_token'   => Str::uuid(),
        ]);
    }
}
