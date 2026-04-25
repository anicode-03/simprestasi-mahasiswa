<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'nim' => ['required', 'string', 'max:20', 'unique:users,nim'],
            'jurusan' => ['required', 'string', 'max:100'],
            'prodi' => ['required', 'string', 'max:100'],
            'no_hp' => ['required', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Ambil angkatan secara otomatis dari NIM (Contoh: E4121 -> 2021) 
        // Atau Anda bisa menambahkan input 'angkatan' di Blade.
        $angkatan = '20' . substr($request->nim, 3, 2); 

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nim' => $request->nim,
            'jurusan' => $request->jurusan,
            'prodi' => $request->prodi,
            'angkatan' => $angkatan,
            'no_hp' => $request->no_hp,
            'role' => 'mahasiswa', // Set default role
        ]);

        event(new Registered($user));

        // Jika ingin langsung ke login tanpa auto-login:
        return redirect()->route('login')->with('status', 'Registrasi berhasil, silakan masuk.');
    }
}
