<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ================= ADMIN SECTION =================

    // Tampilan form login admin
    public function showAdminLogin()
    {
        return view('auth.admin-login'); // Nanti kita buat view ini
    }

    // Proses login admin
    public function loginAdmin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Login pakai guard 'admin'
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard')
                ->with('success', 'Selamat datang Admin!');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }


    // ================= MAHASISWA SECTION =================

    // Tampilan form login mahasiswa
    public function showMahasiswaLogin()
    {
        return view('auth.mahasiswa-login'); // Nanti kita buat view ini
    }

    // Proses login mahasiswa (Manual NIM & Password)
    public function loginMahasiswa(Request $request)
    {
        $credentials = $request->validate([
            'nim' => 'required|string',
            'password' => 'required'
        ]);

        // Cari mahasiswa berdasarkan NIM
        $mahasiswa = Mahasiswa::where('nim', $credentials['nim'])->first();

        if (!$mahasiswa) {
            return back()->withErrors([
                'nim' => 'NIM tidak ditemukan.'
            ])->withInput();
        }

        // Cek password
        if (!Hash::check($credentials['password'], $mahasiswa->password)) {
            return back()->withErrors([
                'password' => 'Password salah.'
            ])->withInput();
        }

        // Login manual
        Auth::guard('mahasiswa')->login($mahasiswa);
        $request->session()->regenerate();

        return redirect()->intended('/mahasiswa/dashboard')
            ->with('success', 'Selamat datang, ' . $mahasiswa->nama_mahasiswa);
    }

    // Proses Logout (Universal)
    public function logout(Request $request)
    {
        // Cek siapa yang login, lalu logout sesuai guard-nya
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } elseif (Auth::guard('mahasiswa')->check()) {
            Auth::guard('mahasiswa')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); // Kembali ke halaman awal
    }
}