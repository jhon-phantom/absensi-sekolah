@extends('admin.layout')

@section('content')
<h1 class="text-2xl font-bold mb-4">Data Guru</h1>

<a href="{{ route('guru.create') }}"
    class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white rounded">
    Tambah Guru
</a>

<table class="w-full bg-white shadow rounded">
    <thead>
        <tr class="bg-gray-200">
            <th class="p-2 text-left">NBM</th>
            <th class="p-2 text-left">Nama</th>
            <th class="p-2 text-left">Mapel</th>
            <th class="p-2 text- left">QR Guru</th>
            <th class="p-2 text-left">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($guru as $g)
        <tr class="border-t">
            <td class="p-2">{{ $g->nbm }}</td>
            <td class="p-2">{{ $g->nama }}</td>
            <td class="p-2">
                {{ $g->mapels->pluck('nama')->join(', ') }}
            </td>
            <td class="p-2">
                {!! QrCode::size(80)->generate($g->qr_token) !!}
            </td>
            <td class="p-2 flex gap-2">
                <a href="{{ route('guru.edit', $g) }}"
                    class="text-blue-600 hover:underline text-sm">
                    Edit
                </a>

                <form action="{{ route('guru.destroy', $g) }}" method="POST"
                    onsubmit="return confirm('Yakin hapus guru ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-600 hover:underline text-sm">
                        Hapus
                    </button>
                </form>
            </td>

        </tr>
        @endforeach
    </tbody>
</table>
@endsection