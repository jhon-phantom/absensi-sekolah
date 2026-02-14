<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mapel;

class MapelController extends Controller
{
    public function index()
    {
        return view('admin.mapel.index', [
            'mapels' => Mapel::latest()->get()
        ]);
    }

    public function create()
    {
        return view('admin.mapel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'unique:mapels,nama'],
        ]);

        Mapel::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('mapel.index');
    }

    public function edit(Mapel $mapel)
    {
        return view('admin.mapel.edit', compact('mapel'));
    }

    public function update(Request $request, Mapel $mapel)
    {
        $request->validate([
            'nama' => ['required', 'unique:mapels,nama,' . $mapel->id],
        ]);

        $mapel->update([
            'nama' => $request->nama,
        ]);

        return redirect()->route('mapel.index');
    }

    public function destroy(Mapel $mapel)
    {
        $mapel->delete();
        return back();
    }
}
