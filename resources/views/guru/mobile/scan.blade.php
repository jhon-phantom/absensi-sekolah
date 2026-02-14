@extends('layouts.mobile')

@section('content')
<div class="flex flex-col items-center space-y-4">

    <h2 class="text-xl font-bold tracking-wide">Scan QR Absensi</h2>
    <p class="text-slate-400 text-sm text-center">
        Arahkan kamera ke QR Code di area sekolah
    </p>

    {{-- FRAME CAMERA --}}
    <div class="relative w-full h-80 rounded-2xl overflow-hidden border border-slate-700 shadow-lg">

        {{-- Kamera --}}
        <div id="reader" class="w-full h-full bg-black"></div>

        {{-- FRAME SCAN --}}
        <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
            <div class="w-52 h-52 border-2 border-green-400 rounded-xl animate-pulse"></div>
        </div>

        {{-- LASER SCAN --}}
        <div class="absolute inset-0 flex justify-center pointer-events-none">
            <div class="w-52 h-1 bg-green-400 opacity-70 animate-scan"></div>
        </div>

    </div>

    {{-- STATUS --}}
    <div id="status" class="text-sm text-slate-300">
        Menunggu scan...
    </div>

</div>

{{-- SOUND --}}
<audio id="beep" src="https://actions.google.com/sounds/v1/cartoon/wood_plank_flicks.ogg"></audio>

<script src="https://unpkg.com/html5-qrcode"></script>

<script>
    const statusEl = document.getElementById('status')
    const beep = document.getElementById('beep')

    function onScanSuccess(decodedText) {
        beep.play()
        statusEl.innerText = 'QR terbaca, verifikasi lokasi...'

        navigator.geolocation.getCurrentPosition(pos => {
            fetch('{{ route("guru.mobile.scan") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        token: decodedText,
                        lat: pos.coords.latitude,
                        lng: pos.coords.longitude
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.redirect) {
                        window.location.href = data.redirect
                    } else {
                        statusEl.innerText = data.message
                    }
                })
        }, () => {
            statusEl.innerText = 'GPS harus aktif'
        })
    }

    new Html5Qrcode("reader").start({
            facingMode: "environment"
        }, {
            fps: 10,
            qrbox: 250
        },
        onScanSuccess
    )
</script>

<style>
    @keyframes scan {
        0% {
            top: 0;
        }

        100% {
            top: 100%;
        }
    }

    .animate-scan {
        position: absolute;
        animation: scan 2s linear infinite;
    }
</style>
@endsection