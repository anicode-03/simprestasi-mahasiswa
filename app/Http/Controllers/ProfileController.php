<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function update(Request $request): RedirectResponse
    {
        $user = auth()->user();
        
        // 1. Validasi
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
            'avatar' => 'nullable|string', // avatar_url di migration Anda
            'new_password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        // 2. Update Tabel Users (Email)
        $user->update([
            'email' => $request->email,
        ]);

        // 3. Update Tabel Mahasiswas (no_hp, alamat, avatar_url)
        // Kita gunakan updateOrCreate untuk jaga-jaga jika data di tabel mahasiswa belum ada
        $user->mahasiswa()->update([
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'avatar_url' => $request->avatar,
        ]);

        // 4. Update Password jika diisi
        if ($request->filled('new_password')) {
            $user->update([
                'password' => Hash::make($request->new_password)
            ]);
        }

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}