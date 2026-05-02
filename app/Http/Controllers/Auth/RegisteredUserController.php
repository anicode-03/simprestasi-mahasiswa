<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Mahasiswa; // Pastikan model Mahasiswa sudah dibuat
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email', 'ends_with:@student.polije.ac.id'],
            'nim' => ['required', 'string', 'max:20', 'unique:mahasiswas,nim'],
            'jurusan' => ['required', 'string', 'max:100'],
            'prodi' => ['required', 'string', 'max:100'],
            'angkatan' => ['required', 'digits:4'],
            'no_hp' => ['required', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Gunakan try-catch agar jika error, kita bisa tahu penyebabnya
        try {
            DB::transaction(function () use ($request) {
                // 1. Simpan ke tabel USERS
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => 'mahasiswa',
                ]);

                // 2. Simpan ke tabel MAHASISWAS
                Mahasiswa::create([
                    'user_id'  => $user->id,
                    'nim'      => $request->nim,
                    'jurusan'  => $request->jurusan,
                    'prodi'    => $request->prodi,
                    'no_hp'    => $request->no_hp,
                    'angkatan' => $request->angkatan,
                ]);

                event(new Registered($user));
            });

            return redirect()->route('login')->with('status', 'Registrasi berhasil, silakan masuk.');
        } catch (\Exception $e) {
            // Jika error, kembali ke form dengan pesan error asli untuk debug
            return back()->withErrors(['error' => 'Gagal mendaftar: ' . $e->getMessage()])->withInput();
        }
    }
}
