<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\AbsensiGuru;

class GuruDashboardController extends Controller
{
    public function index(Request $request)
    {
        $guru = auth()->guard('web')->user()?->guru;

        if (! $guru) {
            abort(403);
        }

        $hariIni = now()->toDateString();

        $absenHariIni = AbsensiGuru::where('guru_id', $guru->id)
            ->where('tanggal', $hariIni)
            ->latest()
            ->first();

        return view('guru.dashboard', [
            'guru' => $guru,
            'absenHariIni' => $absenHariIni
        ]);
    }
}
