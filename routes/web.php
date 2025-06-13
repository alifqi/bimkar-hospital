<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dokter\JadwalPeriksaController;
use App\Http\Controllers\Dokter\ObatController;
use App\Http\Controllers\Dokter\MemeriksaController;
use App\Http\Controllers\Pasien\JanjiPeriksaController;
use App\Http\Controllers\Pasien\RiwayatPeriksaController;

// Halaman awal
Route::get('/', function () {
    return view('welcome');
});

// ======================= ROUTE UNTUK DOKTER =======================
Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->group(function () {
    
    // Dashboard Dokter
    Route::get('/dashboard', function () {
        return view('dokter.dashboard');
    })->name('dokter.dashboard');

    // Jadwal Periksa
    Route::prefix('jadwal-periksa')->group(function () {
        Route::get('/', [JadwalPeriksaController::class, 'index'])->name('dokter.jadwal-periksa.index');
        Route::post('/', [JadwalPeriksaController::class, 'store'])->name('dokter.jadwal-periksa.store');
        Route::patch('/{id}', [JadwalPeriksaController::class, 'update'])->name('dokter.jadwal-periksa.update');
    });

    // Obat
    Route::prefix('obat')->group(function () {
        Route::get('/', [ObatController::class, 'index'])->name('dokter.obat.index');
        Route::get('/create', [ObatController::class, 'create'])->name('dokter.obat.create');
        Route::post('/store', [ObatController::class, 'store'])->name('dokter.obat.store');
        Route::get('/edit/{id}', [ObatController::class, 'edit'])->name('dokter.obat.edit');
        Route::put('/update/{id}', [ObatController::class, 'update'])->name('dokter.obat.update');
        Route::delete('/destroy/{id}', [ObatController::class, 'destroy'])->name('dokter.obat.destroy');
    });

    // Memeriksa Pasien
    Route::prefix('memeriksa')->group(function () {
        Route::get('/', [MemeriksaController::class, 'index'])->name('dokter.memeriksa.index');
        Route::get('/{id}/periksa', [MemeriksaController::class, 'periksa'])->name('dokter.memeriksa.periksa');
        Route::get('/{id}/edit', [MemeriksaController::class, 'edit'])->name('dokter.memeriksa.edit');
        Route::post('/{id}', [MemeriksaController::class, 'store'])->name('dokter.memeriksa.store');
        Route::patch('/{id}', [MemeriksaController::class, 'update'])->name('dokter.memeriksa.update');
    });
});

// ======================= ROUTE UNTUK PASIEN =======================
Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->group(function () {

    // Dashboard Pasien
    Route::get('/dashboard', function () {
        return view('pasien.dashboard');
    })->name('pasien.dashboard');

    // Janji Periksa
    Route::prefix('janji-periksa')->group(function () {
        Route::get('/', [JanjiPeriksaController::class, 'index'])->name('pasien.janji-periksa.index');
        Route::post('/', [JanjiPeriksaController::class, 'store'])->name('pasien.janji-periksa.store');
    });

    // Riwayat Periksa
    Route::prefix('riwayat-periksa')->group(function () {
        Route::get('/', [RiwayatPeriksaController::class, 'index'])->name('pasien.riwayat-periksa.index');
        Route::get('/{id}/detail', [RiwayatPeriksaController::class, 'detail'])->name('pasien.riwayat-periksa.detail');
        Route::get('/{id}/riwayat', [RiwayatPeriksaController::class, 'riwayat'])->name('pasien.riwayat-periksa.riwayat');
    });
});

// ======================= AUTH ROUTES =======================
require __DIR__ . '/auth.php';
