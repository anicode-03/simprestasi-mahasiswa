<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPRESMA POLIJE | Sign Up</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #1e3a8a;
            /* Warna Biru Utama Polije */
        }

        .input-field {
            width: 100%;
            padding: 0.8rem 1.2rem;
            border: 1.5px solid #e5e7eb;
            border-radius: 0.75rem;
            font-size: 0.95rem;
            outline: none;
            transition: all 0.3s ease;
            background-color: #f9fafb;
        }

        .input-field:focus {
            border-color: #1e3a8a;
            background-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(30, 58, 138, 0.1);
        }

        label {
            display: block;
            font-weight: 700;
            font-size: 0.85rem;
            color: #1e3a8a;
            margin-bottom: 0.6rem;
            text-transform: uppercase;
        }

        .custom-scroll::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scroll::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
        }

        .glass-panel {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Toggle Button Group (Sama dengan Sign Up) */
        .auth-toggle {
            display: flex;
            background: #f3f4f6;
            padding: 6px;
            border-radius: 16px;
            margin-bottom: 40px;
            width: fit-content;
        }

        .auth-toggle a,
        .auth-toggle div {
            padding: 12px 35px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
        }

        .toggle-active {
            background: #1e3a8a;
            color: white;
            box-shadow: 0 4px 15px rgba(30, 58, 138, 0.3);
        }

        .toggle-inactive {
            color: #6b7280;
        }

        .toggle-inactive:hover {
            color: #1e3a8a;
        }

        .btn-primary {
            background: #1e3a8a;
            color: white;
            width: 100%;
            padding: 18px;
            border-radius: 16px;
            font-weight: 800;
            font-size: 15px;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            box-shadow: 0 10px 25px rgba(30, 58, 138, 0.2);
            margin-top: 10px;
        }

        .btn-primary:hover {
            background: #152d6a;
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(30, 58, 138, 0.3);
        }

        .illustration-img {
            width: 85%;
            max-width: 500px;
            filter: drop-shadow(0 30px 40px rgba(0,0,0,0.4));
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center overflow-x-hidden">

    <div class="flex w-full min-h-screen">

        <!-- SISI KIRI: INFORMASI & ILUSTRASI -->
        <div class="hidden lg:flex lg:w-[45%] flex-col p-16 text-white justify-center relative overflow-hidden">
            <!-- Ornamen Dekoratif -->
            <div class="absolute top-0 left-0 w-64 h-64 bg-blue-500/20 rounded-full blur-[100px] -translate-x-1/2 -translate-y-1/2"></div>

            <div class="justify-center left-side flex flex-col items-center">
                <div class="mb-10 text-center">
                    <h1 class="text-4xl font-black tracking-tight mb-4">SIMPRESMA</h1>
                    <div class="h-1.5 w-20 bg-yellow-400 mx-auto rounded-full"></div>
                </div>
                <h2 class="text-3xl font-bold mb-8 leading-tight text-center">Mulai Perjalanan Prestasi Anda<br>
                    <span class="text-yellow-400 font-black">Bersama SIMPRESMA POLIJE!</span>
                </h2>
                <img src="asset/img/signup.png" class="illustration-img" alt="Login Illustration" onerror="this.src='https://illustrations.popsy.co/white/achievement.svg'">


                <div class="space-y-6">
                    <p class="text-sm leading-relaxed opacity-80 font-medium">
                        Selamat datang di portal pendaftaran prestasi mahasiswa. Silakan buat akun untuk mulai mendokumentasikan pencapaian akademik dan non-akademik Anda.
                    </p>

                    <div class="glass-panel p-6 rounded-3xl">
                        <h3 class="text-sm font-black mb-4 uppercase tracking-widest text-blue-300">Persyaratan Daftar</h3>
                        <ul class="space-y-4">
                            <li class="flex items-start space-x-3 text-xs">
                                <div class="w-5 h-5 bg-blue-500 rounded-full flex items-center justify-center shrink-0 font-bold">1</div>
                                <span>Mahasiswa aktif Politeknik Negeri Jember.</span>
                            </li>
                            <li class="flex items-start space-x-3 text-xs">
                                <div class="w-5 h-5 bg-blue-500 rounded-full flex items-center justify-center shrink-0 font-bold">2</div>
                                <span>Wajib menggunakan Email Institusi (SSO).</span>
                            </li>
                            <li class="flex items-start space-x-3 text-xs">
                                <div class="w-5 h-5 bg-blue-500 rounded-full flex items-center justify-center shrink-0 font-bold">3</div>
                                <span>Siapkan NIM dan data jurusan yang valid.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- SISI KANAN: FORMULIR REGISTRASI -->
        <div class="w-full lg:w-[55%] bg-white lg:rounded-l-[80px] flex items-center justify-center p-8 md:p-16 relative shadow-[-20px_0_50px_rgba(0,0,0,0.2)]">

            <div class="w-full max-w-xl">
                <!-- Toggle Header -->
                <div class=" mb-5">
                    <!-- Toggle Tab (Identik dengan Sign Up) -->
                    <div class="flex justify-center">
                        <div class="auth-toggle">
                            <a href="{{ route('login') }}" class="toggle-inactive">LOGIN</a>
                            <div class="toggle-active">SIGN UP</div>
                        </div>
                    </div>
                    <div>
                        <h1 class="text-3xl font-black text-slate-800 tracking-tight">Buat Akun</h1>
                        <p class="text-gray-500 font-medium mb-10">Lengkapi detail informasi akun Anda</p>
                    </div>
                </div>

                <!-- Alert Error Global -->
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST" class="space-y-4">
                    @csrf
                    <!-- Baris 1: Nama & NIM -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label><i class="fas fa-user-circle mr-2"></i>Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="input-field" placeholder="Nama Lengkap" required autofocus autocomplete="name">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div>
                            <label><i class="fas fa-id-badge mr-2"></i>NIM Mahasiswa</label>
                            <input type="text" name="nim" value="{{ old('nim') }}" class="input-field" placeholder="E412xxxx" required>
                            <x-input-error :messages="$errors->get('nim')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Baris 2: Email -->
                    <div>
                        <label><i class="fas fa-envelope-open mr-2"></i>Email SSO POLIJE</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="input-field" placeholder="e412xxxx@student.polije.ac.id" required>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Baris 3: Jurusan & Prodi -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label><i class="fas fa-university mr-2"></i>Jurusan</label>
                            <div class="relative">
                                <select name="jurusan" class="input-field appearance-none cursor-pointer pr-10" required>
                                    <option value="" disabled selected>Pilih Jurusan</option>
                                    <option value="JTI">Teknologi Informasi</option>
                                    <option value="JTP">Teknologi Pertanian</option>
                                    <option value="JPM">Produksi Pertanian</option>
                                </select>
                                <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                    <i class="fas fa-chevron-down text-[10px]"></i>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('jurusan')" class="mt-2" />
                        </div>
                        <div>
                            <label><i class="fas fa-graduation-cap mr-2"></i>Program Studi</label>
                            <div class="relative">
                                <select name="prodi" class="input-field appearance-none cursor-pointer pr-10" required>
                                    <option value="" disabled selected>Pilih Prodi</option>
                                    <option value="TIF">Teknik Informatika</option>
                                    <option value="MIF">Manajemen Informatika</option>
                                    <option value="TKK">Teknik Komputer</option>
                                </select>
                                <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                    <i class="fas fa-chevron-down text-[10px]"></i>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('prodi')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Baris 4: WhatsApp -->
                    <div>
                        <label><i class="fas fa-phone-alt mr-2"></i>Nomor WhatsApp Aktif</label>
                        <input type="text" name="no_hp" value="{{ old('no_hp') }}" class="input-field" placeholder="08123xxxxxxx" required>
                        <x-input-error :messages="$errors->get('no_hp')" class="mt-2" />
                    </div>

                    <!-- Baris 5: Password -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label><i class="fas fa-lock mr-2"></i>Kata Sandi</label>
                            <input type="password" name="password" class="input-field" placeholder="••••••••" required>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <div>
                            <label><i class="fas fa-shield-alt mr-2"></i>Konfirmasi</label>
                            <input type="password" name="password_confirmation" class="input-field" placeholder="••••••••" required>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Persetujuan -->
                    <div class="flex items-center space-x-3 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <input type="checkbox" id="agree" name="agree" class="w-5 h-5 rounded border-gray-300 text-blue-900 focus:ring-blue-900 cursor-pointer" required>
                        <label for="agree" class="mb-0 normal-case font-semibold text-slate-500 text-[11px] leading-tight cursor-pointer">
                            Saya menyatakan bahwa data yang saya masukkan adalah benar sesuai data akademik.
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-primary">
                        {{ __('DAFTAR SEKARANG') }}
                    </button>

                    <p class="text-center mt-10 text-sm text-gray-500 font-medium">
                        Sudah Punya Akun? <a href="{{ route('login') }}" class="text-blue-900 font-extrabold hover:underline">Masuk Disini</a>
                    </p>
                </form>
            </div>
        </div>

    </div>

</body>

</html>
