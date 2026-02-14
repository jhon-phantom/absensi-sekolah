@extends('admin.layout')

@section('content')
<h1 class="text-2xl font-bold mb-4">Data Jurusan</h1>

<a href="{{ route('jurusan.create') }}"
    class="px-4 py-2 bg-blue-600 text-white rounded">
    Tambah Jurusan
</a>

<table class="w-full mt-4 bg-white shadow rounded">
    @foreach($jurusan as $j)
    <tr class="border-b">
        <td class="p-2">{{ $j->nama }}</td>
        <td class="p-2 text-right">
            <a href="{{ route('jurusan.edit', $j) }}" class="text-blue-600">Edit</a>
        </td>
    </tr>
    @endforeach
</table>
@endsection