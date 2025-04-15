<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PeriksaController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PasienPeriksaController;
use App\Models\User; 

// ===============================
// 🌐 ROUTE UTAMA & DASHBOARD
// ===============================
Route::get('/', function () {
    return view('welcome');
});

// Dashboard setelah login (untuk semua role, bisa diatur di view)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ===============================
// 🔐 AUTH & PROFILE
// ===============================
require __DIR__.'/auth.php';

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ===============================
// 🧑‍⚕️ DOKTER ROUTES
// ===============================
Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->name('dokter.')->group(function () {
    // Dashboard Dokter
    Route::get('/dashboard', function () {
        return view('dokter.dashboard');
    })->name('dashboard');

    // Pemeriksaan Pasien (CRUD: index, edit, update)
    Route::get('/periksa', [PeriksaController::class, 'index'])->name('periksa.index');
    Route::get('/periksa/{id}/edit', [PeriksaController::class, 'edit'])->name('periksa.edit');  // Halaman edit
    Route::put('/periksa/{id}', [PeriksaController::class, 'update'])->name('periksa.update');  // Untuk proses update

    // Obat (CRUD: tanpa show)
    Route::resource('obat', ObatController::class)->except(['show']);
});

// ===============================
// 🧑‍💼 PASIEN ROUTES
// ===============================
Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->name('pasien.')->group(function () {
    // Dashboard Pasien
    Route::get('/dashboard', function () {
        return view('pasien.dashboard');
    })->name('dashboard');

    // Menampilkan form pemeriksaan (langsung menuju periksa.blade.php)
    Route::get('/periksa', function () {
        // Ambil data dokter
        $dokters = User::where('role', 'dokter')->get();
        return view('pasien.periksa', compact('dokters'));
    })->name('periksa');

    // Menyimpan data pemeriksaan
    Route::post('/periksa', [PasienPeriksaController::class, 'store'])->name('periksa.store');

    // Menampilkan riwayat pemeriksaan
    Route::get('/riwayat', [PasienPeriksaController::class, 'riwayat'])->name('riwayat');

    //halaman detail pemeriksaan
    Route::get('/riwayat/{id}', [PasienPeriksaController::class, 'detail'])->name('periksa.detail');
});
