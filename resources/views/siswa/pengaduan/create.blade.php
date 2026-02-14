@extends('siswa.layout')

@section('content')
<h1 class="text-2xl font-bold mb-4">Form Pengaduan Kelas</h1>

@if(session('success'))
<div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
    {{ session('success') }}
</div>
@endif

<form action="{{ route('siswa.pengaduan.store') }}" method="POST" class="space-y-4 max-w-lg">
    @csrf

    <div>
        <label class="block mb-1 text-sm text-gray-600">Judul</label>
        <input
            type="text"
            name="judul"
            class="w-full p-2 border rounded"
            placeholder="Contoh: Guru belum hadir">
    </div>

    <div>
        <label class="block mb-1 text-sm text-gray-600">Isi Pengaduan</label>
        <textarea
            name="isi"
            rows="5"
            class="w-full p-2 border rounded"
            placeholder="Tuliskan kondisi di kelas hari ini..."></textarea>
    </div>

    <button class="px-4 py-2 bg-blue-600 text-white rounded">
        Kirim Pengaduan
    </button>
</form>
@endsection