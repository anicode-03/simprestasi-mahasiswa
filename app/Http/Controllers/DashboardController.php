<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Tingkat;
use App\Models\Capaian;
use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Halaman utama dashboard (role-based)
     */
    public function index()
    {
        $user = Auth::user();

        // Menggunakan role dari field 'role' atau method helper
        if ($user->role === 'admin' || (method_exists($user, 'isAdmin') && $user->isAdmin())) {
            return $this->adminDashboard();
        }

        if ($user->role === 'mahasiswa' || (method_exists($user, 'isMahasiswa') && $user->isMahasiswa())) {
            return $this->mahasiswaDashboard();
        }

        return view('dashboard');
    }

    /**
     * Dashboard Admin
     */
    private function adminDashboard()
    {
        // Anda bisa menambahkan count data untuk statistik admin di sini
        return view('admin.dashboard');
    }

    /**
     * Dashboard Mahasiswa
     */
    private function mahasiswaDashboard()
    {
        $user = Auth::user()->load('mahasiswa');

        // 1. AMBIL DATA MASTER (WAJIB ADA agar form tidak error 'Undefined variable')
        $kategori = Kategori::all();
        $tingkat = Tingkat::all();
        $capaian = Capaian::all();

        // 2. Ambil prestasi milik mahasiswa (eager loading untuk performa)
        // Di dalam mahasiswaDashboard()
        $prestasi = Prestasi::with(['kategori', 'tingkat', 'capaian'])
            ->where('mahasiswa_id', $user->mahasiswa->id)
            ->latest()
            ->paginate(10); // Pakai paginate, angka 10 artinya 10 data per halaman

        // 3. Kirim ke view (Pastikan variabel $kategori dikirim ke view)
        return view('mahasiswa.dashboard', compact('user', 'prestasi', 'kategori', 'tingkat', 'capaian'));
    }

    /**
     * Update profil user & mahasiswa
     */
    public function updateProfil(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'email'        => 'required|email|unique:users,email,' . $user->id,
            'no_hp'        => 'nullable|string|max:20',
            'alamat'       => 'nullable|string|max:500',
            'avatar_url'   => 'nullable|url',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        $user->update([
            'email' => $request->email,
        ]);

        if ($request->filled('new_password')) {
            $user->update([
                'password' => bcrypt($request->new_password)
            ]);
        }

        if ($user->mahasiswa) {
            $user->mahasiswa->update([
                'no_hp'      => $request->no_hp,
                'alamat'     => $request->alamat,
                'avatar_url' => $request->avatar_url ?? $user->mahasiswa->avatar_url,
            ]);
        }

        return back()->with('success', 'Profil berhasil diperbarui');
    }
}