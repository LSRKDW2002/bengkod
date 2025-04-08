<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PeriksaController;
use App\Http\Controllers\ObatController;

// Route utama (landing page)
Route::get('/', function () {
    return view('welcome');
});

// Default dashboard (fallback, hanya jika user tidak punya role tertentu)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Autentikasi Laravel Breeze/Fortify/Sanctum
require __DIR__.'/auth.php';
Auth::routes();

// Profile Routes (bisa diakses oleh semua yang login)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// PASIEN ROUTES
Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->group(function () {
    Route::get('/dashboard', function () {
        return view('pasien.dashboard');
    })->name('pasien.dashboard');

    Route::get('/periksa', function () {
        return view('pasien.periksa');
    })->name('pasien.periksa');

    Route::get('/riwayat', function () {
        return view('pasien.riwayat');
    })->name('pasien.riwayat');
});


// DOKTER
Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->name('dokter.')->group(function () {
    Route::get('/dashboard', function () {
        return view('dokter.dashboard');
    })->name('dashboard');

    Route::get('/periksa', [PeriksaController::class, 'index'])->name('periksa'); // Ganti sini
    Route::get('/obat', [ObatController::class, 'index'])->name('obat');
});


