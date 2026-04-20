<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Halaman Depan
Route::get('/', function () {
    return view('welcome');
});

// ==================== ADMIN ROUTES ====================
Route::prefix('admin')->group(function () {
    // GET: Tampilkan form login admin
    Route::get('/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
    
    // POST: Proses login admin ⬅️ TAMBAHKAN INI
    Route::post('/login', [AuthController::class, 'loginAdmin']);
    
    // Dashboard admin
    Route::get('/dashboard', function () {
        return "Halo Admin! Ini Dashboard.";
    })->middleware('auth:admin');
});

// ==================== MAHASISWA ROUTES ====================
Route::prefix('mahasiswa')->group(function () {
    // GET: Tampilkan form login mahasiswa
    Route::get('/login', [AuthController::class, 'showMahasiswaLogin'])->name('mahasiswa.login');
    
    // POST: Proses login mahasiswa ⬅️ TAMBAHKAN INI (PENTING!)
    Route::post('/login', [AuthController::class, 'loginMahasiswa']);
    
    // Dashboard mahasiswa
    Route::get('/dashboard', function () {
        return "Halo Mahasiswa! Ini Dashboard.";
    })->middleware('auth:mahasiswa');
});

// Logout (bisa untuk admin/mahasiswa)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');