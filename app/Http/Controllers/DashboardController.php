<?php

namespace App\Http\Controllers;

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

        if ($user->isAdmin()) {
            return $this->adminDashboard();
        }

        if ($user->isMahasiswa()) {
            return $this->mahasiswaDashboard();
        }

        return view('dashboard');
    }

    /**
     * Dashboard Admin
     */
    private function adminDashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * Dashboard Mahasiswa
     */
    private function mahasiswaDashboard()
    {
        $user = Auth::user()->load('mahasiswa');

        // Ambil 3 prestasi terakhir milik mahasiswa
        $prestasis = $user->prestasi()
            ->with(['kategori', 'tingkat', 'capaian'])
            ->latest()
            ->take(3)
            ->get();

        return view('mahasiswa.dashboard', compact('user', 'prestasis'));
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

        // update user
        $user->update([
            'email' => $request->email,
        ]);

        // update password jika diisi
        if ($request->filled('new_password')) {
            $user->update([
                'password' => bcrypt($request->new_password)
            ]);
        }

        // update mahasiswa (aman dari null)
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