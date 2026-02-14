<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Scan Guru</title>
    @vite(['resources/css/app.css'])
</head>

<body class="min-h-screen flex items-center justify-center bg-slate-900 text-white">

    <div class="w-full max-w-md text-center px-6">
        <div class="text-6xl mb-4">🧑‍🏫</div>
        <h1 class="text-3xl font-bold mb-2">Absensi Guru</h1>
        <p class="text-slate-300 mb-6">Scan QR untuk absensi</p>

        <input
            id="qrInput"
            type="text"
            autofocus
            class="w-full p-4 rounded-lg text-center text-black font-semibold"
            placeholder="Scan QR di sini...">

        <div id="result" class="mt-6 text-sm text-slate-300">
            Menunggu scan...
        </div>
    </div>

    <script>
        const input = document.getElementById('qrInput');
        const result = document.getElementById('result');

        input.addEventListener('change', async () => {
            const token = input.value;

            if (!navigator.geolocation) {
                result.innerText = 'Browser tidak mendukung lokasi';
                return;
            }

            navigator.geolocation.getCurrentPosition(async (pos) => {
                const lat = pos.coords.latitude;
                const lng = pos.coords.longitude;

                const res = await fetch('{{ route("guru.scan.post") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document
                            .querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        token,
                        lat,
                        lng
                    })
                });

                const data = await res.json();
                result.innerHTML = `<pre>${JSON.stringify(data, null, 2)}</pre>`;

                input.value = '';
                input.focus();
            }, () => {
                result.innerText = 'Lokasi wajib diaktifkan';
            });
        });
    </script>

</body>

</html>