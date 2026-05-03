<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        // Jika akses langsung ke /mahasiswa/profile
        return redirect()->route('mahasiswa.dashboard');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'email'        => 'required|email|unique:users,email,' . $user->id,
            'no_hp'        => 'nullable|string|max:20',
            'alamat'       => 'nullable|string|max:500',
            'avatar'       => 'nullable|string',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        // Update email di tabel users
        $user->update(['email' => $request->email]);

        // Update password jika diisi
        if ($request->filled('new_password')) {
            $user->update(['password' => bcrypt($request->new_password)]);
        }

        // Update data mahasiswa
        if ($user->mahasiswa) {
            $avatarUrl = $request->avatar
                ? $request->avatar
                : $user->mahasiswa->avatar_url;

            $user->mahasiswa->update([
                'no_hp'      => $request->no_hp,
                'alamat'     => $request->alamat,
                'avatar_url' => $avatarUrl,
            ]);
        }

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
