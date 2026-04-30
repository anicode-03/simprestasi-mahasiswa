@extends('layouts.auth')

@section('title', 'Sign Up')

{{-- ─── Override: right-side lebih lebar untuk form panjang ─── --}}
@push('styles')
<style>
    /* 1. Reset container utama agar tidak mematikan scroll browser */
    html, body {
        height: auto; /* Biarkan tinggi mengikuti konten */
        overflow-y: auto; 
    }

    /* 2. Pastikan wrapper utama (biasanya flex di layout auth) bisa memanjang */
    .auth-container { /* Ganti selector ini dengan class pembungkus utama di layout Anda */
        min-height: 100vh;
        height: auto;
        display: flex;
        flex-wrap: wrap; /* Agar responsif di mobile */
    }

    /* 3. Nonaktifkan scroll internal pada sisi kanan */
    .right-side {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        height: auto; /* Ubah dari 100vh ke auto */
        min-height: 100vh;
        overflow-y: visible; /* Matikan scroll internal */
        padding: 40px 20px;
    }

    /* 4. Pastikan sisi kiri juga mengikuti tinggi konten */
    .left-side {
        height: auto;
        min-height: 100vh;
    }

    /* Lebar konten form tetap terjaga */
    .right-side > .w-full, 
    .right-side > form, 
    .right-side > div { 
        max-width: 600px; 
        width: 100%;
    }

    .input-field-plain {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1.5px solid #e5e7eb;
        border-radius: 0.75rem;
        font-size: 0.95rem;
        background-color: #f9fafb;
    }
    
    @media (max-width: 768px) {
        .grid-cols-2 {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

{{-- ─── Sisi Kiri ─── --}}
@section('left_content')
    <h2 class="text-3xl font-bold mb-8 leading-tight text-center">
        Mulai Perjalanan Prestasi Anda<br>
        <span class="text-yellow-400 font-black">Bersama SIMPRESMA POLIJE!</span>
    </h2>

    <img src="{{ asset('assets/img/signup.png') }}"
         class="illustration-img"
         alt="SignUp Illustration">

    <div class="space-y-6 mt-8">
        <p class="text-sm leading-relaxed opacity-80 font-medium">
            Selamat datang di portal pendaftaran prestasi mahasiswa.
            Silakan buat akun untuk mulai mendokumentasikan pencapaian Anda.
        </p>

        <div class="glass-panel p-6 rounded-3xl text-left">
            <h3 class="text-sm font-black mb-4 uppercase tracking-widest text-blue-300">
                Persyaratan Daftar
            </h3>
            <ul class="space-y-4">
                @foreach ([
                    'Mahasiswa aktif Politeknik Negeri Jember.',
                    'Wajib menggunakan Email Institusi (SSO).',
                    'Siapkan NIM dan data jurusan yang valid.',
                ] as $i => $syarat)
                    <li class="flex items-start space-x-3 text-xs">
                        <div class="w-5 h-5 bg-blue-500 rounded-full flex items-center justify-center shrink-0 font-bold">
                            {{ $i + 1 }}
                        </div>
                        <span>{{ $syarat }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection

{{-- ─── Sisi Kanan ─── --}}
@section('right_content')
    {{-- Toggle Login / Sign Up --}}
    <div class="flex justify-center">
        <div class="auth-toggle mt-4">
            <a href="{{ route('login') }}" class="toggle-inactive">LOGIN</a>
            <div class="toggle-active">SIGN UP</div>
        </div>
    </div>

    {{-- Heading --}}
    <div class="mb-5">
        <h1 class="text-3xl font-black text-slate-800 tracking-tight">Buat Akun</h1>
        <p class="text-gray-500 font-medium mb-6">Lengkapi detail informasi akun Anda</p>
    </div>

    {{-- Pesan Error --}}
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-xl">
            <ul class="list-disc list-inside text-sm space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Registrasi --}}
    <form action="{{ route('register') }}" method="POST" class="space-y-4">
        @csrf

        {{-- Nama & NIM --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="label-register">
                    <i class="fas fa-user-circle mr-2"></i>Nama Lengkap
                </label>
                <input type="text"
                       name="name"
                       value="{{ old('name') }}"
                       class="input-field-plain"
                       placeholder="Nama Lengkap"
                       required autofocus autocomplete="name">
            </div>
            <div>
                <label class="label-register">
                    <i class="fas fa-id-badge mr-2"></i>NIM Mahasiswa
                </label>
                <input type="text"
                       name="nim"
                       value="{{ old('nim') }}"
                       class="input-field-plain"
                       placeholder="E412xxxx"
                       required>
            </div>
        </div>

        {{-- Email --}}
        <div>
            <label class="label-register">
                <i class="fas fa-envelope-open mr-2"></i>Email SSO POLIJE
            </label>
            <input type="email"
                   name="email"
                   value="{{ old('email') }}"
                   class="input-field-plain"
                   placeholder="e412xxxx@student.polije.ac.id"
                   required>
        </div>

        {{-- Jurusan & Prodi --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="label-register">
                    <i class="fas fa-university mr-2"></i>Jurusan
                </label>
                <div class="relative">
                    <select name="jurusan" class="input-field-plain appearance-none cursor-pointer pr-10" required>
                        <option value="" disabled selected>Pilih Jurusan</option>
                        <option value="Teknologi Informasi"    {{ old('jurusan') === 'Teknologi Informasi'  ? 'selected' : '' }}>Teknologi Informasi</option>
                        <option value="Teknologi Pertanian"    {{ old('jurusan') === 'Teknologi Pertanian'  ? 'selected' : '' }}>Teknologi Pertanian</option>
                        <option value="Produksi Pertanian"     {{ old('jurusan') === 'Produksi Pertanian'   ? 'selected' : '' }}>Produksi Pertanian</option>
                    </select>
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                        <i class="fas fa-chevron-down text-[10px]"></i>
                    </div>
                </div>
            </div>
            <div>
                <label class="label-register">
                    <i class="fas fa-graduation-cap mr-2"></i>Program Studi
                </label>
                <div class="relative">
                    <select name="prodi" class="input-field-plain appearance-none cursor-pointer pr-10" required>
                        <option value="" disabled selected>Pilih Prodi</option>
                        <option value="Teknik Informatika"     {{ old('prodi') === 'Teknik Informatika'     ? 'selected' : '' }}>Teknik Informatika</option>
                        <option value="Manajemen Informatika"  {{ old('prodi') === 'Manajemen Informatika'  ? 'selected' : '' }}>Manajemen Informatika</option>
                        <option value="Teknik Komputer"        {{ old('prodi') === 'Teknik Komputer'        ? 'selected' : '' }}>Teknik Komputer</option>
                    </select>
                    <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                        <i class="fas fa-chevron-down text-[10px]"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Nomor WhatsApp --}}
        <div>
            <label class="label-register">
                <i class="fas fa-phone-alt mr-2"></i>Nomor WhatsApp Aktif
            </label>
            <input type="text"
                   name="no_hp"
                   value="{{ old('no_hp') }}"
                   class="input-field-plain"
                   placeholder="08123xxxxxxx"
                   required>
        </div>

        {{-- Password & Konfirmasi --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="label-register">
                    <i class="fas fa-lock mr-2"></i>Kata Sandi
                </label>
                <input type="password"
                       name="password"
                       class="input-field-plain"
                       placeholder="••••••••"
                       required>
            </div>
            <div>
                <label class="label-register">
                    <i class="fas fa-shield-alt mr-2"></i>Konfirmasi
                </label>
                <input type="password"
                       name="password_confirmation"
                       class="input-field-plain"
                       placeholder="••••••••"
                       required>
            </div>
        </div>

        {{-- Pernyataan Persetujuan --}}
        <div class="flex items-center space-x-3 p-4 bg-slate-50 rounded-2xl border border-slate-100">
            <input type="checkbox"
                   id="agree"
                   name="agree"
                   class="w-5 h-5 rounded border-gray-300 text-blue-900 focus:ring-blue-900 cursor-pointer"
                   required>
            <label for="agree" class="mb-0 normal-case font-semibold text-slate-500 text-[11px] leading-tight cursor-pointer">
                Saya menyatakan bahwa data yang saya masukkan adalah benar sesuai data akademik.
            </label>
        </div>

        <button type="submit" class="btn-primary">
            {{ __('DAFTAR SEKARANG') }}
        </button>
    </form>

    <p class="text-center mt-10 text-sm text-gray-500 font-medium">
        Sudah Punya Akun?
        <a href="{{ route('login') }}" class="text-blue-900 font-extrabold hover:underline">
            Masuk Disini
        </a>
    </p>
@endsection