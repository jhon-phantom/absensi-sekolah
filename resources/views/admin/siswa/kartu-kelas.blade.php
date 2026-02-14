<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kartu {{ $kelas->nama }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body {
                background: white;
            }
        }
    </style>
</head>

<body class="p-6 bg-gray-100">

    <h1 class="text-xl font-bold mb-4">Kartu Siswa - {{ $kelas->nama }}</h1>

    <div class="grid grid-cols-2 gap-4">
        @foreach($siswa as $s)
        <div class="w-80 h-48 border rounded-xl shadow bg-white p-4 flex gap-4">
            <div class="w-24 flex items-center justify-center border rounded">
                {!! QrCode::size(80)->generate($s->qr_token) !!}
            </div>

            <div class="flex-1 text-sm">
                <h2 class="font-bold text-lg leading-tight">Kartu Siswa</h2>

                <p class="mt-2 text-gray-600">Nama</p>
                <p class="font-semibold">{{ $s->nama }}</p>



                <p class="mt-1 text-gray-600">Jurusan</p>
                <p class="font-semibold">{{ $s->jurusan?->nama ?? '' }}</p>

            </div>
        </div>
        @endforeach
    </div>

    <script>
        window.print();
    </script>

</body>

</html>