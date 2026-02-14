<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\AbsensiGuru;

class ScanGuruMobileController extends Controller
{
    /**
     * Halaman scan (kamera HP)
     */
    public function index()
    {
        return view('guru.mobile.scan');
    }

    /**
     * Proses hasil scan QR
     */
    public function scan(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'lat'   => 'required',
            'lng'   => 'required',
        ]);

        // 1️⃣ cari guru dari QR
        $guru = Guru::where('qr_token', $request->token)->first();

        if (! $guru) {
            return response()->json([
                'status'  => 'error',
                'message' => 'QR tidak valid'
            ]);
        }

        // 2️⃣ cek lokasi sekolah
        $latSekolah = -8.184013054292594;
        $lngSekolah = 113.70284302114595;
        $radius     = 100; // meter

        $jarak = $this->hitungJarak(
            $request->lat,
            $request->lng,
            $latSekolah,
            $lngSekolah
        );

        if ($jarak > $radius) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Anda berada di luar area sekolah',
                'jarak'   => round($jarak) . ' meter'
            ]);
        }

        // 3️⃣ cek apakah sudah scan hari ini
        $today = now()->toDateString();

        $sudahScan = AbsensiGuru::where('guru_id', $guru->id)
            ->where('tanggal', $today)
            ->exists();

        if ($sudahScan) {
            return response()->json([
                'status'  => 'warning',
                'message' => 'Anda sudah melakukan absensi hari ini'
            ]);
        }

        // 4️⃣ simpan session (BELUM absen)
        session([
            'guru_scan_id' => $guru->id
        ]);

        // 5️⃣ arahkan ke halaman pilih aktivitas
        return response()->json([
            'status'   => 'success',
            'message'  => 'Selamat datang ' . $guru->nama,
            'redirect' => route('guru.activity')
        ]);
    }

    /**
     * Hitung jarak GPS (meter)
     */
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
