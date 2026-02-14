<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kartu Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10">

    <div class="w-80 h-48 border rounded-xl shadow bg-white p-4 flex gap-4">
        <div class="w-24 flex items-center justify-center border rounded">
            {!! QrCode::size(80)->generate($siswa->qr_token) !!}
        </div>

        <div class="flex-1 text-sm">
            <h2 class="font-bold text-lg leading-tight">Kartu Siswa</h2>
            <p class="mt-2 text-gray-600">Nama</p>
            <p class="font-semibold">{{ $siswa->nama }}</p>

            <p class="mt-1 text-gray-600">NIS</p>
            <p class="font-semibold">{{ $siswa->nis }}</p>

            <p class="mt-1 text-gray-600">Kelas</p>
            <p class="font-semibold">{{ $siswa->kelas->nama }}</p>
        </div>
    </div>

    <script>
        window.print();
    </script>

</body>

</html>