<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\TingkatPrestasiController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\VerifikasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/kontak', [KontakController::class, 'index'])->name('kontak.index');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ─── ADMIN ───
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi.index');
        Route::patch('/verifikasi/{id}', [VerifikasiController::class, 'update'])->name('verifikasi.update');
        Route::post('/prestasi/{id}/approve', [PrestasiController::class, 'approve'])->name('prestasi.approve');
        Route::post('/prestasi/{id}/reject', [PrestasiController::class, 'reject'])->name('prestasi.reject');
        Route::post('/prestasi/{id}/revisi', [PrestasiController::class, 'revisi'])->name('prestasi.revisi');
    });

    // ─── MAHASISWA ───
    // Pindahkan ini ke DALAM group mahasiswa di web.php
    Route::middleware(['role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/prestasi', [PrestasiController::class, 'store'])->name('prestasi.store');

        // Tambahkan ini di sini agar 'mahasiswa.prestasi.show' TERSEDIA
        Route::get('/prestasi/{id}', [PrestasiController::class, 'show'])->name('prestasi.show');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    });

    // ─── ROUTE SHOW (bisa diakses mahasiswa & admin) ───
    // Diletakkan di luar grup agar named route 'prestasi.show' tersedia global
    Route::get('/prestasi/{id}', [PrestasiController::class, 'show'])->name('prestasi.show');

    // ─── RESOURCE LAINNYA ───
    Route::resource('kategori', KategoriController::class);
    Route::resource('tingkat_prestasi', TingkatPrestasiController::class);
    Route::resource('prestasi', PrestasiController::class)
        ->except(['store', 'show']); // show & store sudah didefinisikan manual
});

require __DIR__ . '/auth.php';