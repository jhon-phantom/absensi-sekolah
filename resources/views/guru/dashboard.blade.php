@extends('layouts.guru')

@section('content')
<div class="max-w-4xl mx-auto p-6">

    <h1 class="text-3xl font-bold mb-2">
        Halo, {{ $guru->nama }}
    </h1>

    <p class="text-gray-600 mb-6">
        {{ now()->translatedFormat('l, d F Y') }}
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Status Hari Ini --}}
        <div class="bg-white rounded-xl shadow p-5">
            <h2 class="font-semibold text-lg mb-3">Status Hari Ini</h2>

            @if($absenHariIni)
            <p class="text-green-600 font-medium">
                ✔ {{ strtoupper($absenHariIni->status) }}
            </p>
            <p class="text-sm text-gray-500 mt-1">
                Jam: {{ $absenHariIni->jam }}
            </p>
            @else
            <p class="text-red-600 font-medium">
                ❌ Belum Absen
            </p>
            @endif
        </div>

        {{-- Mapel --}}
        <div class="bg-white rounded-xl shadow p-5">
            <h2 class="font-semibold text-lg mb-3">Mata Pelajaran</h2>
            <p class="text-gray-700">
                {{ $guru->mapels->pluck('nama')->join(', ') }}
            </p>
        </div>

    </div>

    {{-- Aksi --}}
    <div class="mt-8 flex gap-4">
        <a href="{{ route('guru.scan') }}"
            class="px-5 py-3 bg-blue-600 text-white rounded-lg shadow">
            Scan Absen
        </a>

        <a href="{{ route('guru.izin') }}"
            class="px-5 py-3 bg-yellow-500 text-white rounded-lg shadow">
            Izin / Tugas
        </a>
    </div>

</div>
@endsection