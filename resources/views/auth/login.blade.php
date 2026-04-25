<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPRESMA POLIJE | Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #1e3a8a; 
            height: 100vh;
            width: 100vw;
            display: flex;
            overflow: hidden;
        }

        .main-container {
            display: flex;
            width: 100%;
            height: 100%;
        }

        /* SISI KIRI: KONTEN BIRU */
        .left-side {
            flex: 1;
            background-color: #1e3a8a;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 60px;
            color: white;
            position: relative;
        }

        /* SISI KANAN: FORM PUTIH */
        .right-side {
            background-color: white;
            flex: 1.2; 
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 80px;
            /* Lengkungan yang masuk ke area biru */
            border-radius: 80px 0 0 80px; 
            z-index: 10;
            box-shadow: -20px 0 50px rgba(0,0,0,0.2);
        }

        @media (max-width: 1024px) {
            body { overflow: auto; height: auto; }
            .main-container { flex-direction: column; }
            .right-side { border-radius: 40px 40px 0 0; padding: 40px 20px; }
            .left-side { padding: 40px 20px; }
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

        .auth-toggle a, .auth-toggle div {
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

        .input-group {
            position: relative;
            margin-bottom: 24px;
        }

        .input-group i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 18px;
        }

        .input-field {
            width: 100%;
            padding: 16px 16px 16px 52px;
            border: 2px solid #f3f4f6;
            border-radius: 16px;
            outline: none;
            transition: all 0.3s;
            font-size: 15px;
            background: #f9fafb;
            color: #1f2937;
        }

        .input-field:focus {
            border-color: #1e3a8a;
            background: white;
            box-shadow: 0 0 0 4px rgba(30, 58, 138, 0.1);
        }

        label {
            display: block;
            font-weight: 700;
            font-size: 0.85rem;
            color: #1e3a8a;
            margin-bottom: 0.6rem;
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
<body>

    <div class="main-container">
        <!-- SISI KIRI -->
        <div class="left-side">
            <div class="mb-10">
                <h1 class="text-4xl font-black tracking-tight mb-4">SIMPRESMA</h1>
                <div class="h-1.5 w-20 bg-yellow-400 mx-auto rounded-full"></div>
            </div>
            
            <h2 class="text-3xl font-bold mb-8 leading-tight">
                Selamat Datang Kembali<br>
                <span class="text-yellow-400 font-black">Mahasiswa Berprestasi POLIJE!</span>
            </h2>

            <img src="asset/img/login.png" class="illustration-img" alt="Login Illustration" onerror="this.src='https://illustrations.popsy.co/white/achievement.svg'">

            <p class="mt-12 text-blue-100 opacity-80 max-w-sm text-sm font-medium">
                Masuk untuk mencatat pencapaian akademik dan non-akademik Anda di Politeknik Negeri Jember.
            </p>
        </div>

        <!-- SISI KANAN -->
        <div class="right-side">
            <div class="w-full max-w-md">
                
                <!-- Toggle Tab (Identik dengan Sign Up) -->
                <div class="flex justify-center">
                    <div class="auth-toggle">
                        <div class="toggle-active">LOGIN</div>
                        <a href="{{ route('register') }}" class="toggle-inactive">SIGN UP</a>
                    </div>
                </div>

                <div class="text-left mb-8">
                    <h3 class="text-3xl font-black text-gray-900 mb-2">Selamat Datang!</h3>
                    <p class="text-gray-500 font-medium">Silakan masukkan akun SSO Anda.</p>
                </div>

                <form id="loginForm" action="{{ route('login') }}" method= "POST">
                    @csrf
                    <div>
                        <label>Email Institusi</label>
                        <div class="input-group">
                            <i class="fas fa-envelope"></i>
                            <input type="email" id="email" required class="input-field" placeholder="e412xxxx@student.polije.ac.id" name="email" :value="old('email')" required autofocus autocomplete="username">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <label>Kata Sandi</label>
                        <div class="input-group">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="password" required class="input-field" placeholder="••••••••••••" name="password" required autocomplete="current-password">
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center">
                            <input type="checkbox" id="remember_me" class="w-4 h-4 rounded border-gray-300 text-blue-900 focus:ring-blue-900" name= "remember">
                            <label for="remember" class="ml-2 mb-0 text-xs font-semibold text-gray-500 cursor-pointer">{{ __('Remember me') }}</label>
                        </div>
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-xs font-bold text-blue-900 hover:underline">
                            {{ __('Lupa password?') }}
                        </a>
                        @endif
                    </div>

                    <button type="submit" class="btn-primary" {{ __('Log in')}}>
                        MASUK SEKARANG
                    </button>
                </form>

                <p class="text-center mt-10 text-sm text-gray-500 font-medium">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="text-blue-900 font-extrabold hover:underline">Daftar Akun Baru</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        
        function showToast(message) {
            const toast = document.createElement('div');
            toast.style.cssText = `
                position: fixed;
                bottom: 30px;
                left: 50%;
                transform: translateX(-50%);
                background: #1f2937;
                color: white;
                padding: 16px 30px;
                border-radius: 12px;
                font-weight: bold;
                font-size: 14px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.3);
                z-index: 9999;
                animation: slideUp 0.3s ease-out;
            `;
            toast.innerText = message;
            document.body.appendChild(toast);
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transition = '0.5s';
                setTimeout(() => toast.remove(), 500);
            }, 3000);
        }

        const style = document.createElement('style');
        style.innerHTML = `@keyframes slideUp { from { bottom: -50px; opacity: 0; } to { bottom: 30px; opacity: 1; } }`;
        document.head.appendChild(style);
    </script>
</body>
</html>