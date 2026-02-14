@extends('admin.layout')

@section('content')
<h1 class="text-2xl font-bold mb-4">Daftar Pengaduan</h1>

<table class="w-full bg-white shadow rounded">
    <thead>
        <tr class="bg-gray-200">
            <th class="p-2 text-left">Waktu</th>
            <th class="p-2 text-left">Siswa</th>
            <th class="p-2 text-left">Kelas</th>
            <th class="p-2 text-left">Judul</th>
            <th class="p-2 text-left">Isi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($pengaduan as $p)
        <tr class="border-t align-top">
            <td class="p-2 text-sm text-gray-500">
                {{ $p->created_at->format('d/m/Y H:i') }}
            </td>
            <td class="p-2">{{ $p->siswa->nama }}</td>
            <td class="p-2">{{ $p->kelas->nama }}</td>
            <td class="p-2 font-semibold">{{ $p->judul }}</td>
            <td class="p-2 text-gray-700">{{ $p->isi }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="p-4 text-center text-gray-500">
                Belum ada pengaduan.
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection