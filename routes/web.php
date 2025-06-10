<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dokter\JadwalPeriksaController;
use App\Http\Controllers\Dokter\ObatController;

Route::get('/', function () {
    return view('welcome');
});

// Route untuk Dokter
Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->group(function () {
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
    
    // Obat
    Route::prefix('obat')->group(function () {
        Route::get('/', [ObatController::class, 'index'])->name('dokter.obat.index');
        Route::get('/create/', [ObatController::class, 'create'])->name('dokter.obat.create');
        Route::post('/store', [ObatController::class, 'store'])->name('dokter.obat.store');
        Route::get('/edit/{id}', [ObatController::class, 'edit'])->name('dokter.obat.edit');
        Route::put('/update/{id}', [ObatController::class, 'update'])->name('dokter.obat.update');
        Route::delete('/destroy/{id}', [ObatController::class, 'destroy'])->name('dokter.obat.destroy');
    });

});

// Route untuk Pasien
Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->group(function () {
    // Dashboard pasien
    Route::get('/dashboard', function () {
        return view('pasien.dashboard');
    })->name('pasien.dashboard');
});

// Auth routes
require __DIR__.'/auth.php';
