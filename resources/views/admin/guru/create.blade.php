@extends('admin.layout')

@section('content')
<h1 class="text-2xl font-bold mb-4">Tambah Guru</h1>
@if ($errors->any())
<div class="bg-red-100 border border-red-400 text-red-700 p-3 rounded mb-4">
    <ul class="text-sm list-disc pl-5">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{ route('guru.store') }}" class="space-y-4 max-w-md">
    @csrf

    <input type="text" name="nbm" placeholder="NBM" class="w-full p-2 border rounded">
    <input type="text" name="nama" placeholder="Nama Guru" class="w-full p-2 border rounded">
    <input type="password" name="password" placeholder="Password" class="w-full p-2 border rounded">

    <div class="border rounded p-3">
        <p class="text-sm font-semibold mb-2">Mata Pelajaran</p>
        @foreach($mapels as $m)
        <label class="block text-sm">
            <input type="checkbox" name="mapels[]" value="{{ $m->id }}">
            {{ $m->nama }}
        </label>
        @endforeach
    </div>

    <button class="px-4 py-2 bg-green-600 text-white rounded">
        Simpan
    </button>
</form>
@endsection