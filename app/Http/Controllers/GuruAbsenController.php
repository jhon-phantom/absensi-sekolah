<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AbsensiGuru;

class GuruAbsenController extends Controller
{
    public function pilih()
    {
        $guru = auth()->guard('web')->user()?->guru;

        $absenHariIni = AbsensiGuru::where('guru_id', $guru->id)
            ->whereDate('tanggal', now())
            ->first();

        if ($absenHariIni) {
            return redirect()
                ->route('guru.dashboard')
                ->with('info', 'Anda sudah absen hari ini');
        }

        return view('guru.absen.pilih', compact('guru'));
    }

    public function hadir(Request $request)
    {
        $guru = auth()->guard('web')->user()?->guru;

        AbsensiGuru::create([
            'guru_id'   => $guru->id,
            'tanggal'   => now()->toDateString(),
            'jam_masuk' => now()->format('H:i:s'),
            'status'    => 'hadir',
        ]);

        return redirect()
            ->route('guru.dashboard')
            ->with('success', 'Absensi masuk kelas berhasil');
    }

    public function kegiatan(Request $request)
    {
        $request->validate([
            'keterangan' => 'required'
        ]);

        $guru = auth()->guard('web')->user()?->guru;

        AbsensiGuru::create([
            'guru_id'   => $guru->id,
            'tanggal'   => now()->toDateString(),
            'jam_masuk' => now()->format('H:i:s'),
            'status'    => 'kegiatan',
            'keterangan' => $request->keterangan,
        ]);

        return redirect()
            ->route('guru.dashboard')
            ->with('success', 'Absensi kegiatan dicatat');
    }

    public function izin()
    {
        return view('guru.absen.izin');
    }
}
