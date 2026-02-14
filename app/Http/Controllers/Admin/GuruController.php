<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\User;
use App\Models\Mapel;
use Illuminate\Support\Facades\DB;

class GuruController extends Controller
{
    public function index()
    {
        return view('admin.guru.index', [
            'guru' => Guru::with('mapels')->get()
        ]);
    }

    public function create()
    {
        return view('admin.guru.create', [
            'mapels' => Mapel::all()
        ]);
    }

    public function store(Request $request)
    {
        //dd($request->all());

        $request->validate([
            'nbm'      => 'required|unique:gurus,nbm',
            'nama'     => 'required',
            'password' => 'required|min:6',
            'mapels'   => 'required|array',
        ]);

        DB::transaction(function () use ($request) {

            $user = User::create([
                'name'     => $request->nama,
                'email'    => $request->nbm . '@guru.local',
                'password' => bcrypt($request->password),
                'role'     => 'guru',
            ]);

            $guru = Guru::create([
                'nbm'     => $request->nbm,
                'nama'    => $request->nama,
                'user_id' => $user->id,
            ]);

            $guru->mapels()->sync($request->mapels);
        });

        return redirect()->route('guru.index')
            ->with('success', 'Guru berhasil ditambahkan');
    }

    public function edit(Guru $guru)
    {
        $mapels = Mapel::all();

        return view('admin.guru.edit', compact('guru', 'mapels'));
    }


    public function update(Request $request, Guru $guru)
    {
        $request->validate([
            'nbm'  => 'required',
            'nama' => 'required',
        ]);

        $guru->update([
            'nbm'  => $request->nbm,
            'nama' => $request->nama,
        ]);

        // sinkronisasi mapel
        $guru->mapels()->sync($request->mapels ?? []);

        return redirect()->route('guru.index')
            ->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy(Guru $guru)
    {
        $guru->delete();

        return redirect()->route('guru.index')
            ->with('success', 'Data guru berhasil dihapus.');
    }
}
