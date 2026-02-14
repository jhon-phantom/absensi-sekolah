@extends('admin.layout')

@section('content')
<h1 class="text-xl font-bold mb-4">Tambah Jurusan</h1>

<form method="POST" action="{{ route('jurusan.store') }}">
    @csrf
    <input type="text" name="nama" class="border p-2 w-full mb-3" placeholder="Nama Jurusan">
    <button class="px-4 py-2 bg-green-600 text-white rounded">Simpan</button>
</form>
@endsection