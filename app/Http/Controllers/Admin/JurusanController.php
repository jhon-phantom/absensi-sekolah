<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        return view('admin.jurusan.index', [
            'jurusan' => Jurusan::all()
        ]);
    }

    public function create()
    {
        return view('admin.jurusan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['required']
        ]);

        Jurusan::create([
            'nama' => $request->nama
        ]);

        return redirect()->route('jurusan.index');
    }

    public function edit(Jurusan $jurusan)
    {
        return view('admin.jurusan.edit', compact('jurusan'));
    }

    public function update(Request $request, Jurusan $jurusan)
    {
        $request->validate([
            'nama' => ['required']
        ]);

        $jurusan->update([
            'nama' => $request->nama
        ]);

        return redirect()->route('jurusan.index');
    }

    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();
        return back();
    }
}
