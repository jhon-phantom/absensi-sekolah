<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Monitor Absensi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f4f8;
            /* Light background color */
            color: #333;
            /* Dark text color for better readability */
        }



        .input-card {
            background: rgba(255, 255, 255, 0.9);
            /* Slightly more opaque */
            border-radius: 15px;
            /* Adjusted border radius */
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            /* Softer shadow */
        }

        .result-card {
            border-radius: 10px;
            /* Adjusted border radius */
            padding: 15px;
            transition: transform 0.2s;
        }

        .result-card:hover {
            transform: scale(1.02);
            /* Slightly less scaling on hover */
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center">

    <div class="relative z-10 text-center w-full max-w-md px-8">
        <div class="mb-8 flex justify-center">
            <div class="text-7xl">🎓</div>
        </div>

        <h1 class="text-4xl font-bold mb-2">Sistem Absensi</h1>
        <h2 class="text-2xl font-semibold mb-4">SMK Muhammadiyah 02 Paleran</h2>
        <p class="text-blue-600 mb-8 text-lg">Scan QR Code untuk presensi</p>

        <div class="input-card">
            <input
                id="qrInput"
                type="text"
                autofocus
                class="w-full text-gray-900 p-4 rounded-lg text-center text-lg font-semibold focus:outline-none focus:ring-2 focus:ring-blue-400 transition placeholder-gray-500"
                placeholder="Scan QR di sini...">
        </div>

        <div id="result" class="mt-8 min-h-24 flex items-center justify-center">
            <div class="text-blue-600 text-sm">⏳ Menunggu scan QR...</div>
        </div>

        <div class="mt-12 text-blue-600 text-sm border-t border-gray-300 pt-6">
            <p>Pastikan koneksi stabil untuk pengalaman terbaik</p>
        </div>
    </div>

    <script>
        const input = document.getElementById('qrInput');
        const result = document.getElementById('result');

        function formatTime(date) {
            return date.toLocaleString('id-ID', {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            });
        }

        input.addEventListener('keydown', async (e) => {
            if (e.key === 'Enter') {
                const token = input.value;
                const scanTime = formatTime(new Date());

                try {
                    const res = await fetch('/scan', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            token
                        })
                    });

                    const data = await res.json();

                    let card = '';
                    let title = '';
                    let color = '';
                    let emoji = '';

                    if (data.status === 'success') {
                        if (data.status_absen === 'hadir') {
                            color = 'green';
                            title = 'Selamat Datang';
                            emoji = '🌞';
                        } else {
                            color = 'yellow';
                            title = 'Terlambat';
                            emoji = '⏰';
                        }

                        card = `
        <div class="result-card bg-${color}-100 border border-${color}-400 p-6 w-full">
            <div class="text-${color}-800 font-bold text-2xl mb-1">${emoji} ${title}</div>
            <div class="text-gray-800 font-semibold text-xl">${data.nama}</div>
            <div class="text-gray-600 text-sm mb-2">${data.kelas}</div>
            <div class="text-gray-500 text-xs mb-4">🕐 ${scanTime}</div>
            <div class="inline-block bg-${color}-500 text-white px-6 py-2 rounded-lg font-bold text-lg">
                ${data.status_absen.toUpperCase()}
            </div>
        </div>
    `;
                    } else if (data.status === 'warning') {
                        card = `
        <div class="result-card bg-blue-100 border border-blue-400 p-6 w-full">
            <div class="text-blue-800 font-bold text-xl mb-1">ℹ️ Sudah Absen</div>
            <div class="text-gray-800 font-semibold text-lg">${data.nama}</div>
            <div class="text-gray-600 text-sm mb-2">${data.kelas}</div>
            <div class="text-gray-500 text-xs">🕐 ${scanTime}</div>
        </div>
    `;
                    } else {
                        card = `
        <div class="result-card bg-red-100 border border-red-400 p-6 w-full">
            <div class="text-red-800 font-bold text-xl mb-1">❌ Gagal</div>
            <div class="text-red-600 text-sm mb-2">${data.message}</div>
            <div class="text-red-500 text-xs">🕐 ${scanTime}</div>
        </div>
    `;
                    }

                    result.innerHTML = card;

                } catch (error) {
                    result.innerHTML = `
                <div class="result-card bg-red-100 border border-red-400 p-6 w-full">
                    <div class="text-red-800 font-bold">❌ Terjadi Kesalahan</div>
                    <div class="text-red-600 text-xs mt-2">🕐 ${formatTime(new Date())}</div>
                </div>
            `;
                }

                input.value = '';
                input.focus();
            }
        });
    </script>

</body>

</html>