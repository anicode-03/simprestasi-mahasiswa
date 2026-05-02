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

    {{-- Pesan Sukses Setelah Registrasi --}}
    @if (session('success'))
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-r-xl shadow-sm flex items-center">
            <i class="fas fa-check-circle text-green-500 mr-3"></i>
            <span class="text-sm font-bold text-green-800">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Status Bawaan Breeze (Lupa Password, dll) --}}
    @if (session('status'))
        <div class="mb-6 p-4 bg-blue-50 border-l-4 border-blue-500 rounded-r-xl shadow-sm flex items-center">
            <i class="fas fa-info-circle text-blue-500 mr-3"></i>
            <span class="text-sm font-bold text-blue-800">{{ session('status') }}</span>
        </div>
    @endif

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
            <label class="block text-sm font-bold text-gray-700 mb-1">Email Institusi</label>
            <div class="input-group relative">
                <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       class="input-field pl-11 w-full p-3 border rounded-xl focus:ring-2 focus:ring-blue-900"
                       placeholder="e412xxxx@student.polije.ac.id"
                       required
                       autofocus>
            </div>
        </div>

        <div class="mt-4">
            <label class="block text-sm font-bold text-gray-700 mb-1">Kata Sandi</label>
            <div class="input-group relative">
                <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="password"
                       name="password"
                       class="input-field pl-11 w-full p-3 border rounded-xl focus:ring-2 focus:ring-blue-900"
                       placeholder="••••••••••••"
                       required>
            </div>
        </div>

        {{-- Remember Me & Lupa Password --}}
        <div class="flex items-center justify-between mt-4 mb-8">
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

        <button type="submit" class="btn-primary w-full py-3 bg-blue-900 text-white font-bold rounded-xl hover:bg-blue-800 transition shadow-lg">
            MASUK SEKARANG
        </button>
    </form>

    <p class="text-center mt-10 text-sm text-gray-500 font-medium">
        Belum punya akun?
        <a href="{{ route('register') }}" class="text-blue-900 font-extrabold hover:underline">
            Daftar Akun Baru
        </a>
    </p>
@endsection