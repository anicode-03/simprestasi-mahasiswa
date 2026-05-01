<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\TingkatPrestasiController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\VerifikasiController;

// route dasar
Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::resource('kategori', KategoriController::class);


//route wajib login
Route::middleware('auth')->group(function () {

    //dashboard bawaan breeze
    Route::get('/dashboard', function () {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('mahasiswa.dashboard');
    })->name('dashboard');

    // route admin
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Route khusus Mahasiswa
    Route::get('/mahasiswa/dashboard', function () {
        return view('mahasiswa.dashboard'); // Pastikan file view ini ada
    })->name('mahasiswa.dashboard');

    //crud kategori

    //crud tingkat prestasi
    Route::resource('tingkat_prestasi', TingkatPrestasiController::class);

    //verifikasi pengajuan (admin only)
    Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi.index');
    Route::patch('/verifikasi/{id}', [VerifikasiController::class, 'update'])->name('verifikasi.update');

    Route::resource('prestasi', PrestasiController::class);
});

require __DIR__ . '/auth.php';
