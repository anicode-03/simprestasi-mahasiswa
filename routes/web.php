<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\TingkatPrestasiController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\VerifikasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

// ─── ROUTE DASAR ───
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/kontak', [KontakController::class, 'index'])->name('kontak.index');

// ─── ROUTE WAJIB LOGIN ───
Route::middleware('auth')->group(function () {

    // Route Dashboard Tunggal (Fallback)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ─── GRUP ADMIN ───
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi.index');
        Route::patch('/verifikasi/{id}', [VerifikasiController::class, 'update'])->name('verifikasi.update');
    });

    // ─── GRUP MAHASISWA ───
    Route::middleware(['role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Route Profile diletakkan di sini (Hanya untuk Mahasiswa)
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    });

    // ─── RESOURCE ROUTES (Umum) ───
    Route::resource('kategori', KategoriController::class);
    Route::resource('tingkat_prestasi', TingkatPrestasiController::class);
    Route::resource('prestasi', PrestasiController::class);

    Route::post('/prestasi/{id}/approve', [PrestasiController::class, 'approve']);
    Route::post('/prestasi/{id}/reject', [PrestasiController::class, 'reject']);
    Route::post('/prestasi/{id}/revisi', [PrestasiController::class, 'revisi']);
});

require __DIR__ . '/auth.php';