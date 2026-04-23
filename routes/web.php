<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TingkatPrestasiController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\VerifikasiController;

// route dasar
Route::get('/', function () {
    return view('welcome');
});

//route wajib login
Route::middleware('auth')->group(function (){

    //dashboard bawaan breeze
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');



    // route admin
    Route::get('/admin/dashboard', function (){
        return view('admin.dashboard');
    })->name('admin.dashboard');




    //crud kategori
    Route::resource('kategori', KategoriController::class);


    //crud tingkat prestasi
    Route::resource('tingkat_prestasi', TingkatPrestasiController::class);


    //verifikasi pengajuan (admin only)
    Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi.index');
    Route::patch('/verifikasi/{id}', [VerifikasiController::class, 'update'])->name('verifikasi.update');




    //route mahasiswa
    Route::get('/mahasiswa/dashboard', function (){
        return view('mahasiswa.dashboard');
    })->name('mahasiswa.dashboard');
    
    Route::resource('prestasi', PrestasiController::class);
});

require __DIR__.'/auth.php';
