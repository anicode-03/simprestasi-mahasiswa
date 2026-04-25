<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use Illuminate\Support\Facades\Auth;
=======
>>>>>>> 4a6959e74b98b988baa3a3278a73292e64c885fe
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TingkatPrestasiController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\VerifikasiController;

// route dasar
Route::get('/', function () {
    return view('welcome');
<<<<<<< HEAD
})->name('welcome');
=======
});
>>>>>>> 4a6959e74b98b988baa3a3278a73292e64c885fe

//route wajib login
Route::middleware('auth')->group(function (){

    //dashboard bawaan breeze
    Route::get('/dashboard', function () {
<<<<<<< HEAD
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('mahasiswa.dashboard');
    })->name('dashboard');

    // Route khusus Admin
=======
        return view('dashboard');
    })->name('dashboard');

>>>>>>> 4a6959e74b98b988baa3a3278a73292e64c885fe


    // route admin
    Route::get('/admin/dashboard', function (){
        return view('admin.dashboard');
    })->name('admin.dashboard');

<<<<<<< HEAD
    // Route khusus Mahasiswa
    Route::get('/mahasiswa/dashboard', function (){
        return view('mahasiswa.dashboard'); // Pastikan file view ini ada
    })->name('mahasiswa.dashboard');
=======

>>>>>>> 4a6959e74b98b988baa3a3278a73292e64c885fe


    //crud kategori
    Route::resource('kategori', KategoriController::class);


    //crud tingkat prestasi
    Route::resource('tingkat_prestasi', TingkatPrestasiController::class);


    //verifikasi pengajuan (admin only)
    Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi.index');
    Route::patch('/verifikasi/{id}', [VerifikasiController::class, 'update'])->name('verifikasi.update');

<<<<<<< HEAD
=======



    //route mahasiswa
    Route::get('/mahasiswa/dashboard', function (){
        return view('mahasiswa.dashboard');
    })->name('mahasiswa.dashboard');
    
    Route::resource('prestasi', PrestasiController::class);
>>>>>>> 4a6959e74b98b988baa3a3278a73292e64c885fe
});

require __DIR__.'/auth.php';
