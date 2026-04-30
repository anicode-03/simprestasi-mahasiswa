@extends('layouts.auth')

@section('title', 'Login')

{{-- ─── Sisi Kiri ─── --}}
@section('left_content')
    <h2 class="text-3xl font-bold mb-8 leading-tight">
        Selamat Datang Kembali<br>
        <span class="text-yellow-400 font-black">Mahasiswa Berprestasi POLIJE!</span>
    </h2>

    <img src="{{ asset('assets/img/login.png') }}"
         class="illustration-img"
         alt="Login Illustration">

    <p class="mt-12 text-blue-100 opacity-80 max-w-sm text-sm font-medium">
        Masuk untuk mencatat pencapaian akademik dan non-akademik Anda
        di Politeknik Negeri Jember.
    </p>
@endsection

{{-- ─── Sisi Kanan ─── --}}
@section('right_content')
    {{-- Toggle Login / Sign Up --}}
    <div class="flex justify-center">
        <div class="auth-toggle">
            <div class="toggle-active">LOGIN</div>
            <a href="{{ route('register') }}" class="toggle-inactive">SIGN UP</a>
        </div>
    </div>

    {{-- Heading --}}
    <div class="text-left mb-8">
        <h3 class="text-3xl font-black text-gray-900 mb-2">Selamat Datang!</h3>
        <p class="text-gray-500 font-medium">Silakan masukkan akun SSO Anda.</p>
    </div>

    {{-- Pesan Error --}}
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-xl shadow-sm">
            <div class="flex items-center mb-2">
                <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                <span class="text-sm font-bold text-red-800">Ups! Terjadi kesalahan:</span>
            </div>
            <ul class="list-disc list-inside text-xs text-red-700 space-y-1 ml-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Login --}}
    <form action="{{ route('login') }}" method="POST">
        @csrf

        {{-- Email --}}
        <div>
            <label>Email Institusi</label>
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       class="input-field"
                       placeholder="e412xxxx@student.polije.ac.id"
                       required
                       autofocus>
            </div>
        </div>

        {{-- Password --}}
        <div>
            <label>Kata Sandi</label>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password"
                       name="password"
                       class="input-field"
                       placeholder="••••••••••••"
                       required>
            </div>
        </div>

        {{-- Remember Me & Lupa Password --}}
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center">
                <input type="checkbox"
                       id="remember_me"
                       name="remember"
                       class="w-4 h-4 rounded border-gray-300 text-blue-900 focus:ring-blue-900">
                <label for="remember_me" class="ml-2 mb-0 text-xs font-semibold text-gray-500 cursor-pointer">
                    Ingat saya
                </label>
            </div>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   class="text-xs font-bold text-blue-900 hover:underline">
                    Lupa password?
                </a>
            @endif
        </div>

        <button type="submit" class="btn-primary">MASUK SEKARANG</button>
    </form>

    <p class="text-center mt-10 text-sm text-gray-500 font-medium">
        Belum punya akun?
        <a href="{{ route('register') }}" class="text-blue-900 font-extrabold hover:underline">
            Daftar Akun Baru
        </a>
    </p>
@endsection