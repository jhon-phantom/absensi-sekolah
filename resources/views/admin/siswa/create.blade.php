@extends('admin.layout')

@section('content')
<h1 class="text-2xl font-bold mb-4">Tambah Siswa</h1>

<form method="POST" action="{{ route('siswa.store') }}" class="space-y-4 max-w-md">
    @csrf

    <div class="flex items-center gap-2">
        <input type="checkbox" name="is_ketua" value="1" id="is_ketua">
        <label for="is_ketua" class="text-sm text-gray-700">
            Jadikan Ketua Kelas
        </label>
    </div>

    <div id="password-field" class="hidden">
        <input
            type="password"
            name="password"
            placeholder="Password Ketua Kelas"
            class="w-full p-2 border rounded">
    </div>

    <input
        type="text"
        name="nis"
        placeholder="NIS"
        class="w-full p-2 border rounded">

    <input
        type="text"
        name="nama"
        placeholder="Nama Siswa"
        class="w-full p-2 border rounded">

    <select name="kelas_id" class="w-full p-2 border rounded">
        @foreach($kelas as $k)
        <option value="{{ $k->id }}">{{ $k->nama }}</option>
        @endforeach
    </select>

    <button class="px-4 py-2 bg-green-600 text-white rounded">
        Simpan
    </button>
</form>

<script>
    const checkbox = document.getElementById('is_ketua');
    const pass = document.getElementById('password-field');

    checkbox.addEventListener('change', () => {
        pass.classList.toggle('hidden', !checkbox.checked);
    });
</script>

@endsection