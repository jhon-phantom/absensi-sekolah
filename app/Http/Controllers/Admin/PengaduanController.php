<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;

class PengaduanController extends Controller
{
    public function index()
    {
        return view('admin.pengaduan.index', [
            'pengaduan' => Pengaduan::with(['siswa', 'kelas'])->latest()->get()
        ]);
    }
}
