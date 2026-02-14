<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\AbsensiGuru;

class ScanGuruController extends Controller
{
    public function scan(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'lat'   => 'required',
            'lng'   => 'required',
        ]);

        $guru = Guru::where('qr_token', $request->token)->first();

        if (! $guru) {
            return response()->json([
                'status' => 'error',
                'message' => 'QR tidak valid'
            ]);
        }

        // koordinat sekolah
        // $latSekolah = -8.215308452834062;
        // $lngSekolah = 113.50079617338884;
        // $radius = 100; // meter

        $latSekolah = -8.183998452379065;
        $lngSekolah = 113.70285576163815;
        $radius = 100; // meter

        $jarak = $this->hitungJarak(
            $request->lat,
            $request->lng,
            $latSekolah,
            $lngSekolah
        );

        if ($jarak > $radius) {
            return response()->json([
                'status' => 'error',
                'message' => 'Di luar area sekolah',
                'jarak' => round($jarak) . ' meter'
            ]);
        }

        $today = now()->toDateString();

        // ⛔ cegah scan berulang
        $already = AbsensiGuru::where('guru_id', $guru->id)
            ->where('tanggal', $today)
            ->where('status', 'hadir')
            ->exists();

        if ($already) {
            return response()->json([
                'status' => 'info',
                'message' => 'Anda sudah melakukan absensi hari ini'
            ]);
        }

        // ✅ simpan absensi
        AbsensiGuru::create([
            'guru_id'   => $guru->id,
            'tanggal'   => $today,
            'jam_masuk' => now()->format('H:i:s'),
            'status'    => 'hadir',
        ]);

        return response()->json([
            'status'  => 'success',
            'guru'    => $guru->nama,
            'message' => 'Absensi berhasil'
        ]);
    }

    private function hitungJarak($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            cos(deg2rad($theta));

        $dist = acos($dist);
        $dist = rad2deg($dist);
        return $dist * 60 * 1.1515 * 1609.344;
    }
}
