<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\AbsensiSiswa;

class ScanController extends Controller
{
    public function scan(Request $request)
    {
        $token = $request->input('token');

        $siswa = Siswa::with(['kelas', 'jurusan'])
            ->where('qr_token', $token)
            ->first();

        if (! $siswa) {
            return response()->json([
                'status' => 'error',
                'message' => 'QR tidak valid'
            ]);
        }

        $hariIni = now()->toDateString();
        $jam = now();

        $absen = AbsensiSiswa::where('siswa_id', $siswa->id)
            ->where('tanggal', $hariIni)
            ->first();

        // Belum ada data hari ini → DATANG
        if (! $absen) {
            $status = $jam->format('H:i') > '07:00' ? 'terlambat' : 'hadir';

            AbsensiSiswa::create([
                'siswa_id' => $siswa->id,
                'tanggal' => $hariIni,
                'jam_masuk' => $jam->format('H:i:s'),
                'status' => $status,
            ]);

            return response()->json([
                'status' => 'success',
                'mode' => 'datang',
                'nama' => $siswa->nama,
                'kelas' => optional($siswa->kelas)->nama ?? '-',
                'status_absen' => $status,
            ]);
        }

        // Sudah datang tapi belum pulang → PULANG
        if ($absen && $absen->jam_pulang === null) {
            $absen->update([
                'jam_pulang' => $jam->format('H:i:s'),
            ]);

            return response()->json([
                'status' => 'success',
                'mode' => 'pulang',
                'nama' => $siswa->nama,
                'kelas' => optional($siswa->kelas)->nama ?? '-',
                'status_absen' => 'pulang',
            ]);
        }

        // Sudah datang & pulang
        return response()->json([
            'status' => 'warning',
            'message' => 'Absensi hari ini sudah lengkap',
            'nama' => $siswa->nama,
            'kelas' => optional($siswa->kelas)->nama ?? '-',
        ]);
    }
}
