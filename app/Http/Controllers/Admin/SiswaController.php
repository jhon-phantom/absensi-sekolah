<?php

namespace App\Http\Controllers\Admin;

use App\Imports\SiswaImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Jurusan;



class SiswaController extends Controller
{
    public function index()
    {
        return view('admin.siswa.index', [
            'siswa' => Siswa::with('kelas', 'jurusan')->get()
        ]);
    }

    public function create()
    {
        return view('admin.siswa.create', [
            'kelas' => Kelas::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis'       => ['required', 'unique:siswas'],
            'nama'      => ['required'],
            'kelas_id'  => ['required'],
            'password'  => ['nullable'],
        ]);

        $isKetua = $request->has('is_ketua');

        $siswa = Siswa::create([
            'nis'      => $request->nis,
            'nama'     => $request->nama,
            'kelas_id' => $request->kelas_id,
            'qr_token' => Str::uuid(),
            'is_ketua' => $isKetua,
        ]);

        // Jika ditandai sebagai ketua kelas
        if ($isKetua) {
            $user = User::create([
                'name'     => $request->nama,
                'email'    => $request->nis . '@siswa.local',
                'password' => bcrypt($request->password ?: '123456'),
                'role'     => 'siswa',
            ]);

            $siswa->update([
                'user_id' => $user->id,
            ]);
        }

        return redirect()->route('siswa.index');
    }


    public function edit(Siswa $siswa)
    {
        return view('admin.siswa.edit', compact('siswa'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $siswa->update($request->all());
        return redirect()->route('admin.siswa.index');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return back();
    }


    public function resetPassword(Request $request, Siswa $siswa)
    {
        $request->validate([
            'password' => ['required', 'min:6'],
        ]);

        if (! $siswa->user) {
            return back()->with('error', 'Siswa ini belum memiliki akun.');
        }

        $siswa->user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password berhasil direset.');
    }

    public function kartu(Siswa $siswa)
    {
        return view('admin.siswa.kartu', compact('siswa'));
    }

    public function kartuPerKelas(Kelas $kelas)
    {
        $siswa = $kelas->siswas()->with('kelas')->get();

        return view('admin.siswa.kartu-kelas', compact('kelas', 'siswa'));
    }

    public function import(Request $request)
    {
        // HAPUS dd()
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new SiswaImport, $request->file('file'));

        return redirect()
            ->route('siswa.index')
            ->with('success', 'Data siswa berhasil diimport.');
    }
}
