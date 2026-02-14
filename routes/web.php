<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\PengaduanController as AdminPengaduan;
use App\Http\Controllers\Siswa\PengaduanController as SiswaPengaduan;
use App\Http\Controllers\ScanGuruController;
use App\Http\Controllers\GuruScanController;
use App\Http\Controllers\GuruDashboardController;
use App\Http\Controllers\GuruAbsenController;
use App\Http\Controllers\ScanGuruMobileController;

Route::get('/', function () {
    return view('monitor');
});

/*
|--------------------------------------------------------------------------
| AUTH DEFAULT
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::resource('kelas', KelasController::class);
    Route::resource('siswa', SiswaController::class);

    Route::post('/siswa/{siswa}/reset-password', [SiswaController::class, 'resetPassword'])
        ->name('admin.siswa.reset-password');


    Route::prefix('admin')->name('admin.')->group(function () {
        Route::post('/siswa/import', [SiswaController::class, 'import'])->name('siswa.import');
    });



    Route::resource('guru', \App\Http\Controllers\Admin\GuruController::class);
    Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
        Route::resource('guru', \App\Http\Controllers\Admin\GuruController::class);
    });

    Route::resource('mapel', \App\Http\Controllers\Admin\MapelController::class);

    Route::prefix('admin')->middleware(['auth'])->group(function () {
        Route::resource('jurusan', \App\Http\Controllers\Admin\JurusanController::class);
    });

    Route::resource('siswa', SiswaController::class);


    // Pengaduan untuk admin (lihat & kelola)
    Route::get('/pengaduan', [AdminPengaduan::class, 'index'])
        ->name('admin.pengaduan.index');

    Route::get('/admin/siswa/{siswa}/kartu', [SiswaController::class, 'kartu'])
        ->name('admin.siswa.kartu');

    Route::get('/admin/kelas/{kelas}/kartu', [SiswaController::class, 'kartuPerKelas'])
        ->name('admin.kelas.kartu');
});

/*
|--------------------------------------------------------------------------
| SISWA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->group(function () {
    Route::get('/', function () {
        return view('siswa.dashboard');
    })->name('siswa.dashboard');

    // Pengaduan untuk siswa (kirim laporan)
    Route::get('/pengaduan', [SiswaPengaduan::class, 'create'])
        ->name('siswa.pengaduan.create');

    Route::post('/pengaduan', [SiswaPengaduan::class, 'store'])
        ->name('siswa.pengaduan.store');
});

Route::middleware(['auth', 'role:guru'])->get('/guru', function () {
    return view('guru.dashboard');
})->name('guru.dashboard');

/*
|--------------------------------------------------------------------------
| LAINNYA
|--------------------------------------------------------------------------
*/
Route::post('/scan', [ScanController::class, 'scan']);
Route::post('/scan/guru', [ScanGuruController::class, 'scan']);

Route::get('/guru/scan', fn() => view('guru.scan'))->name('guru.scan');
Route::post('/guru/scan', [ScanGuruController::class, 'scan']);

Route::get('/guru/scan', [ScanGuruController::class, 'index'])
    ->name('guru.scan');
Route::post('/guru/scan', [ScanGuruController::class, 'scan'])
    ->name('guru.scan.post');

Route::get('/guru/scan', function () {
    return view('guru.scan');
})->name('guru.scan');

Route::post('/scan/guru', [ScanGuruController::class, 'scan'])
    ->name('guru.scan.post');

Route::post('/guru/izin', [ScanGuruController::class, 'izin'])
    ->name('guru.izin');
// routes/web.php
Route::get('/guru/dashboard', [GuruDashboardController::class, 'index'])
    ->name('guru.dashboard');


Route::middleware(['auth', 'role:guru'])->group(function () {

    Route::get('/guru/absen/pilih', [GuruAbsenController::class, 'pilih'])
        ->name('guru.absen.pilih');

    Route::post('/guru/absen/hadir', [GuruAbsenController::class, 'hadir'])
        ->name('guru.absen.hadir');

    Route::post('/guru/absen/kegiatan', [GuruAbsenController::class, 'kegiatan'])
        ->name('guru.absen.kegiatan');

    Route::get('/guru/absen/izin', [GuruAbsenController::class, 'izin'])
        ->name('guru.absen.izin');
});

Route::get('/guru/mobile/scan', function () {
    return view('guru.mobile.scan');
})->name('guru.mobile.scan.page');


Route::post('/guru/mobile/scan', [ScanGuruMobileController::class, 'scan'])
    ->name('guru.mobile.scan');


require __DIR__ . '/auth.php';
