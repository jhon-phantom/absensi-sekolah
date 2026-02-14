<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Panel Siswa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen flex">

    <aside class="w-64 bg-blue-900 text-white p-6">
        <h1 class="text-2xl font-bold mb-8">Ketua Kelas</h1>

        <nav class="space-y-3">
            <a href="{{ route('siswa.dashboard') }}" class="block hover:text-blue-300">
                Dashboard
            </a>

            <a href="{{ route('siswa.pengaduan.create') }}" class="block hover:text-blue-300">
                Kirim Pengaduan
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="text-red-600 hover:underline">
                    Logout
                </button>
            </form>

        </nav>
    </aside>

    <main class="flex-1 p-8">
        @yield('content')
    </main>

</body>

</html>