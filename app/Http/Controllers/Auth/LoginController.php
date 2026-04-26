<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email'    => 'required|email|ends_with:@student.polije.ac.id',
            'password' => 'required',
        ], [
            'email.ends_with' => 'Email harus menggunakan domain @student.polije.ac.id',
        ]);


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            //redirect berdasarkan role
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }
            return redirect()->intended('/mahasiswa/dashboard');
        }
        return back()->withErrors(['email' => 'Email atau password salah']);    
    }
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
