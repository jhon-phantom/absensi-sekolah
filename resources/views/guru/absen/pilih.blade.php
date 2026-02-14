@extends('layouts.guru')

@section('content')
<div class="max-w-3xl mx-auto p-6">

    <h1 class="text-2xl font-bold mb-2">
        Selamat Datang, {{ $guru->nama }}
    </h1>

    <p class="text-gray-600 mb-6">
        Silakan pilih aktivitas Anda hari ini
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        {{-- Masuk Kelas --}}
        <form action="{{ route('guru.absen.hadir') }}" method="POST">
            @csrf
            <button class="w-full bg-blue-600 text-white p-6 rounded-xl shadow hover:bg-blue-700">
                <div class="text-4xl mb-2">🧑‍🏫</div>
                <div class="font-semibold text-lg">Masuk Kelas</div>
            </button>
        </form>

        {{-- Kegiatan / Rapat --}}
        <form action="{{ route('guru.absen.kegiatan') }}" method="POST">
            @csrf
            <input
                type="hidden"
                name="keterangan"
                value="Kegiatan / Rapat Sekolah">

            <button class="w-full bg-green-600 text-white p-6 rounded-xl shadow hover:bg-green-700">
                <div class="text-4xl mb-2">🏫</div>
                <div class="font-semibold text-lg">Kegiatan / Rapat</div>
            </button>
        </form>

        {{-- Izin --}}
        <a href="{{ route('guru.absen.izin') }}"
            class="block bg-yellow-500 text-white p-6 rounded-xl shadow hover:bg-yellow-600 text-center">
            <div class="text-4xl mb-2">📝</div>
            <div class="font-semibold text-lg">Izin / Tugas</div>
        </a>

    </div>

</div>
@endsection