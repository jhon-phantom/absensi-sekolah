@extends('admin.layout')

@section('content')
<h1 class="text-2xl font-bold mb-4">Tambah Mapel</h1>

<form method="POST" action="{{ route('mapel.store') }}" class="space-y-4 max-w-md">
    @csrf
    <input type="text" name="nama" placeholder="Nama Mapel"
        class="w-full p-2 border rounded">
    <button class="px-4 py-2 bg-green-600 text-white rounded">Simpan</button>
</form>
@endsection