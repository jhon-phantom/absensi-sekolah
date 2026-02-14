@extends('siswa.layout')

@section('content')
<h1 class="text-3xl font-bold mb-4">Dashboard Ketua Kelas</h1>

<p class="text-gray-600 mb-6">
    Di sini kamu bisa melaporkan kondisi kelas hari ini.
    Gunakan dengan jujur dan bertanggung jawab.
</p>

<a href="{{ route('siswa.pengaduan.create') }}"
    class="inline-block px-4 py-2 bg-blue-600 text-white rounded">
    Buat Pengaduan
</a>
@endsection