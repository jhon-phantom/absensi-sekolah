<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Absensi Guru')</title>

    @vite(['resources/css/app.css'])
</head>

<body class="bg-gradient-to-b from-slate-900 to-black text-white min-h-screen flex flex-col">

    <header class="p-4 text-center border-b border-slate-800">
        <div class="text-3xl">🧑‍🏫</div>
        <h1 class="text-lg font-semibold tracking-wide">
            @yield('header', 'Absensi Guru')
        </h1>
        <p class="text-xs text-slate-400">
            {{ now()->translatedFormat('l, d F Y') }}
        </p>
    </header>

    <main class="flex-1 p-4">
        <div class="max-w-md mx-auto">
            @yield('content')
        </div>
    </main>

    <footer class="p-2 text-center text-xs text-slate-600">
        © {{ date('Y') }} Sistem Absensi Sekolah
    </footer>

</body>

</html>