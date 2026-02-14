@extends('admin.layout')

@section('content')
<h1 class="text-2xl font-bold mb-4">Data Mapel</h1>

<a href="{{ route('mapel.create') }}"
    class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white rounded">
    Tambah Mapel
</a>

<table class="w-full bg-white shadow rounded">
    <thead>
        <tr class="bg-gray-200">
            <th class="p-2 text-left">Nama</th>
            <th class="p-2 text-right">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($mapels as $m)
        <tr class="border-t">
            <td class="p-2">{{ $m->nama }}</td>
            <td class="p-2 text-right">
                <a href="{{ route('mapel.edit', $m) }}" class="text-blue-600 mr-2">Edit</a>
                <form action="{{ route('mapel.destroy', $m) }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button class="text-red-600">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection