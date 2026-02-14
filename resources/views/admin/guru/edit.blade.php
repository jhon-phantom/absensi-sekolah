@extends('admin.layout')

@section('content')
<h1 class="text-2xl font-bold mb-4">Edit Guru</h1>

<form action="{{ route('guru.update', $guru) }}" method="POST" class="max-w-md space-y-4">
    @csrf
    @method('PUT')

    <input
        type="text"
        name="nbm"
        value="{{ old('nbm', $guru->nbm) }}"
        class="w-full p-2 border rounded"
        placeholder="NBM">

    <input
        type="text"
        name="nama"
        value="{{ old('nama', $guru->nama) }}"
        class="w-full p-2 border rounded"
        placeholder="Nama Guru">

    @foreach($mapels as $m)
    <label class="flex items-center gap-2 text-sm">
        <input
            type="checkbox"
            name="mapels[]"
            value="{{ $m->id }}"
            {{ $guru->mapels->contains($m->id) ? 'checked' : '' }}>
        {{ $m->nama }}
    </label>
    @endforeach

    <button class="px-4 py-2 bg-blue-600 text-white rounded">
        Update
    </button>
</form>
@endsection