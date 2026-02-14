<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Absensi Sekolah</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50">

    <!-- Sidebar -->
    <aside class="fixed left-0 top-0 w-64 h-screen bg-gradient-to-b from-gray-900 to-gray-800 text-white shadow-lg">
        <div class="p-6 border-b border-gray-700">
            <h1 class="text-2xl font-bold">Admin Panel</h1>
            <p class="text-gray-400 text-sm">Absensi Sekolah</p>
        </div>

        <nav class="p-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-700 transition">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4z"></path>
                    <path d="M3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6z"></path>
                </svg>
                Dashboard
            </a>
            <a href="{{ route('kelas.index') }}"
                class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-700 transition">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                </svg>
                Kelas
            </a>
            <a href="{{ route('siswa.index') }}"
                class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-700 transition">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.5 1.5H4.75A1.25 1.25 0 003.5 2.75v14.5A1.25 1.25 0 004.75 18.5h10.5a1.25 1.25 0 001.25-1.25V2.75a1.25 1.25 0 00-1.25-1.25z"></path>
                </svg>
                Siswa
            </a>
            <a href="{{ route('guru.index') }}"
                class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-700 transition">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v4h8v-4zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12a3.995 3.995 0 001.5-7.676A3.5 3.5 0 00.5 9.5v4.25h4.25z"></path>
                </svg>
                Guru
            </a>
            <a href="{{ route('admin.pengaduan.index') }}"
                class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-700 transition">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2.5 3A1.5 1.5 0 001 4.5v.006c0 .596.182 1.129.487 1.587A1.5 1.5 0 001 7.5V19a2 2 0 002 2h14a2 2 0 002-2V7.5a1.5 1.5 0 00-.487-1.907C18.818 5.635 19 5.102 19 4.506V4.5A1.5 1.5 0 0017.5 3h-15z"></path>
                </svg>
                Pengaduan
            </a>
            <a href="{{ route('mapel.index') }}"
                class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-700 transition">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0113 2.586V4h.5A1.5 1.5 0 0115 5.5v9a1.5 1.5 0 01-1.5 1.5H4a2 2 0 01-2-2V4z"></path>
                </svg>
                Mapel
            </a>
            <a href="{{ route('jurusan.index') }}"
                class="flex items-center px-4 py-3 rounded-lg hover:bg-gray-700 transition">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0113 2.586V4h.5A1.5 1.5 0 0115 5.5v9a1.5 1.5 0 01-1.5 1.5H4a2 2 0 01-2-2V4z"></path>
                </svg>
                Jurusan
            </a>

        </nav>

        <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full flex items-center px-4 py-3 text-red-400 hover:bg-red-900 hover:bg-opacity-20 rounded-lg transition">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h12a1 1 0 100-2H4V5a1 1 0 00-1-1zm0 5a1 1 0 100 2h6a1 1 0 100-2H3z"></path>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Content -->
    <main class="ml-64 p-8">
        <div class="max-w-7xl mx-auto">
            @yield('content')
        </div>
    </main>

</body>

</html>