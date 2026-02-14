<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaduan;

class PengaduanController extends Controller
{
    public function create()
    {
        return view('siswa.pengaduan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => ['required'],
            'isi'   => ['required'],
        ]);

        $siswa = $request->user()->siswa;

        Pengaduan::create([
            'siswa_id' => $siswa->id,
            'kelas_id' => $siswa->kelas_id,
            'judul'    => $request->judul,
            'isi'      => $request->isi,
        ]);

        return redirect('/siswa')->with('success', 'Pengaduan berhasil dikirim.');
    }
}
