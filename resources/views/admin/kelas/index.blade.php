@extends('admin.layout')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-2">Data Kelas</h1>
    <p class="text-gray-600">Kelola data kelas sekolah Anda</p>
</div>

<div class="mb-6">
    <a href="{{ route('kelas.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow transition duration-200">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Tambah Kelas
    </a>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="w-full">
        <thead class="bg-gradient-to-r from-blue-600 to-blue-700 text-white">
            <tr>
                <th class="p-4 text-left font-semibold">No</th>
                <th class="p-4 text-left font-semibold">Nama Kelas</th>
                <th class="p-4 text-left font-semibold">Jurusan</th>
                <th class="p-4 text-left font-semibold">Aksi</th>
                <th class="p-4 text-left font-semibold">Kartu Siswa</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kelas as $k)
            <tr class="border-b hover:bg-gray-50 transition duration-150">
                <td class="p-4 text-gray-700">{{ $loop->iteration }}</td>
                <td class="p-4 text-gray-700 font-medium">{{ $k->nama }}</td>
                <td class="p-4 text-gray-700">
                    {{ $k->jurusan?->nama ?? '-' }}
                </td>

                <td class="p-4">
                    <a href="#" class="text-blue-600 hover:text-blue-800 mr-3">Edit</a>
                    <a href="#" class="text-red-600 hover:text-red-800">Hapus</a>
                </td>
                <td class="p-4">
                    <a href="{{ route('admin.kelas.kartu', $k) }}"
                        target="_blank"
                        class="text-blue-600 text-sm hover:underline">
                        Cetak Kartu Kelas
                    </a>

                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="p-4 text-center text-gray-500">Tidak ada data kelas</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection