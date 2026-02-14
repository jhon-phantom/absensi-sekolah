@extends('admin.layout')

@section('content')
<h1 class="text-3xl font-bold mb-8 tracking-tight text-gray-800">
    Dashboard Admin
</h1>

<div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-10">
    <div class="relative overflow-hidden p-6 bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-xl shadow-lg">
        <p class="text-sm opacity-80">Total Siswa</p>
        <p class="text-4xl font-bold mt-2">{{ \App\Models\Siswa::count() }}</p>
        <span class="absolute -bottom-6 -right-6 text-8xl opacity-10">👨‍🎓</span>
    </div>

    <div class="relative overflow-hidden p-6 bg-gradient-to-br from-emerald-500 to-emerald-600 text-white rounded-xl shadow-lg">
        <p class="text-sm opacity-80">Total Kelas</p>
        <p class="text-4xl font-bold mt-2">{{ \App\Models\Kelas::count() }}</p>
        <span class="absolute -bottom-6 -right-6 text-8xl opacity-10">🏫</span>
    </div>

    <div class="relative overflow-hidden p-6 bg-gradient-to-br from-indigo-500 to-indigo-600 text-white rounded-xl shadow-lg">
        <p class="text-sm opacity-80">Total Guru</p>
        <p class="text-4xl font-bold mt-2">{{ \App\Models\Guru::count() }}</p>
        <span class="absolute -bottom-6 -right-6 text-8xl opacity-10">👩‍🏫</span>
    </div>

    <div class="relative overflow-hidden p-6 bg-gradient-to-br from-pink-500 to-pink-600 text-white rounded-xl shadow-lg">
        <p class="text-sm opacity-80">Total Mapel</p>
        <p class="text-4xl font-bold mt-2">{{ \App\Models\Mapel::count() }}</p>
        <span class="absolute -bottom-6 -right-6 text-8xl opacity-10">📚</span>
    </div>

    <div class="relative overflow-hidden p-6 bg-gradient-to-br from-amber-500 to-amber-600 text-white rounded-xl shadow-lg">
        <p class="text-sm opacity-80">Total Pengaduan</p>
        <p class="text-4xl font-bold mt-2">{{ \App\Models\Pengaduan::count() }}</p>
        <span class="absolute -bottom-6 -right-6 text-8xl opacity-10">📣</span>
    </div>
</div>

<div class="bg-white shadow-lg rounded-xl p-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold text-gray-800">
            Pengaduan Terbaru
        </h2>
        <a href="{{ route('admin.pengaduan.index') }}"
            class="text-sm text-blue-600 hover:text-blue-700 hover:underline">
            Lihat Semua →
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b bg-gray-50">
                    <th class="p-3 text-left font-medium text-gray-500">Waktu</th>
                    <th class="p-3 text-left font-medium text-gray-500">Kelas</th>
                    <th class="p-3 text-left font-medium text-gray-500">Judul</th>
                </tr>
            </thead>
            <tbody>
                @foreach(\App\Models\Pengaduan::latest()->take(5)->get() as $p)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="p-3 text-gray-500">
                        {{ $p->created_at->format('d/m H:i') }}
                    </td>
                    <td class="p-3">
                        {{ $p->kelas->nama }}
                    </td>
                    <td class="p-3 font-medium text-gray-800">
                        {{ $p->judul }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection