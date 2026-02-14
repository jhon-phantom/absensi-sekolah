@extends('admin.layout')

@section('content')
<h1 class="text-2xl font-bold mb-4">Edit Mapel</h1>

<form method="POST" action="{{ route('mapel.update', $mapel) }}" class="space-y-4 max-w-md">
    @csrf @method('PUT')
    <input type="text" name="nama" value="{{ $mapel->nama }}"
        class="w-full p-2 border rounded">
    <button class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
</form>
@endsection