@extends('admin.layout')

@section('content')
<h1 class="text-2xl font-bold mb-4">Data Siswa</h1>


<div class="mb-6 flex flex-wrap gap-3 items-center">
    <a href="{{ route('siswa.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Tambah Siswa
    </a>

    <a href="{{ asset('template/template_siswa.xlsx') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow transition">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
        </svg>
        Download Template
    </a>

    <form action="{{ route('admin.siswa.import') }}" method="POST" enctype="multipart/form-data" class="flex gap-2 items-center">
        @csrf
        <label class="flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow cursor-pointer transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
            </svg>
            <span id="file-label">Pilih File</span>
            <input type="file" name="file" id="file-input" class="hidden" required>
        </label>
        <button class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg shadow transition">
            Import
        </button>
    </form>
</div>



<table class="w-full bg-white shadow rounded">
    <thead>
        <tr class="bg-gray-200">
            <th class="p-2 text-left">NIS</th>
            <th class="p-2 text-left">Nama</th>
            <th class="p-2 text-left">Kelas</th>
            <th class="p-2 text-left">QR</th>
            <th class="p-2 text-left">Password</th>
            <th class="p-2 text-left">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($siswa as $s)
        <tr class="border-t">
            <td class="p-2">{{ $s->nis }}</td>
            <td class="p-2">{{ $s->nama }}</td>
            <td class="p-2">
                {{ $s->kelas?->nama ?? '-' }}
                {{ $s->jurusan?->nama ?? '' }}
            </td>



            <td class="p-2">
                {!! QrCode::size(80)->generate($s->qr_token) !!}
            </td>
            <td class="p-2">
                @if($s->is_ketua && $s->user)
                <form action="{{ route('admin.siswa.reset-password', $s) }}" method="POST" class="flex gap-1">
                    @csrf
                    <input
                        type="text"
                        name="password"
                        placeholder="Password baru"
                        class="border rounded px-2 py-1 text-sm w-28"
                        required>
                    <button class="text-blue-600 hover:underline text-sm">
                        Reset
                    </button>
                </form>
                @else
                <span class="text-gray-400 text-sm">-</span>
                @endif
            </td>
            <td class="p-2 space-x-1">
                <a href="{{ route('admin.siswa.kartu', $s) }}"
                    target="_blank"
                    class="px-2 py-1 bg-blue-600 text-white rounded text-xs">
                    Cetak
                </a>

                <a href="{{ route('siswa.edit', $s) }}"
                    class="px-2 py-1 bg-yellow-500 text-white rounded text-xs">
                    Edit
                </a>

                <form action="{{ route('siswa.destroy', $s) }}"
                    method="POST"
                    class="inline"
                    onsubmit="return confirm('Yakin mau hapus siswa ini?')">
                    @csrf
                    @method('DELETE')
                    <button
                        class="px-2 py-1 bg-red-600 text-white rounded text-xs">
                        Hapus
                    </button>
                </form>
            </td>


        </tr>
        @endforeach
    </tbody>
</table>

<script>
    const input = document.getElementById('file-input');
    const label = document.getElementById('file-label');

    input.addEventListener('change', function() {
        if (this.files.length > 0) {
            label.textContent = this.files[0].name;
        } else {
            label.textContent = 'Pilih File';
        }
    });
</script>
@endsection