<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dokter\JadwalPeriksaController;
use App\Http\Controllers\Dokter\ObatController;

// Route untuk Dokter
Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->group(function () {

    // Halaman utama dokter
    Route::get('/', function () {
        return view('welcome');
    });

    // Dashboard dokter
    Route::get('/dashboard', function () {
        return view('dokter.dashboard');
    })->name('dokter.dashboard');

    // Jadwal Periksa
    Route::prefix('jadwal-periksa')->group(function () {
        Route::get('/', [JadwalPeriksaController::class, 'index'])->name('dokter.jadwal-periksa.index');
        Route::post('/', [JadwalPeriksaController::class, 'store'])->name('dokter.jadwal-periksa.store');
        Route::patch('/{id}', [JadwalPeriksaController::class, 'update'])->name('dokter.jadwal-periksa.update');
    });
});

// Route untuk Pasien
Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->group(function () {
    // Dashboard pasien
    Route::get('/dashboard', function () {
        return view('pasien.dashboard');
    })->name('pasien.dashboard');
});

// Route untuk obat
Route::middleware(['auth', 'role:dokter'])->group(function () {
    Route::resource('obat', ObatController::class);
});

// Route default (root URL)
Route::get('/', function () {
    return view('auth.login');
});

// Auth routes
require __DIR__.'/auth.php';
