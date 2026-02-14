@extends('admin.layout')

@section('content')
<h1 class="text-2xl font-bold mb-4">Tambah Kelas</h1>

<form method="POST" action="{{ route('kelas.store') }}" class="space-y-4 max-w-md">
    @csrf

    <input
        type="text"
        name="nama"
        placeholder="Nama Kelas"
        class="w-full p-2 border rounded">
    <select name="jurusan_id" class="w-full border rounded p-2">
        @foreach($jurusans as $j)
        <option value="{{ $j->id }}">{{ $j->nama }}</option>
        @endforeach
    </select>


    <button class="px-4 py-2 bg-green-600 text-white rounded">
        Simpan
    </button>
</form>
@endsection