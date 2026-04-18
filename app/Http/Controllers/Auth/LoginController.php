<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function showLoginForm() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            //redirect berdasarkan role
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }
            return redirect()->intended('/mahasiswa/dashboard');
        }
        return back()->withErros(['username' => 'Username atau password salah']);    
    }
    public function logout(Request $request) {
        Auth::logout();
        $request->sessions()->invalidate();
        $request->sessions()->regenerateToken();
        return redirect('/login');
    }
}
