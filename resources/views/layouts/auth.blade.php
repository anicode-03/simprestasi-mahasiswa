<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPRESMA POLIJE | @yield('title')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');

        /* ─── Reset & Base ─── */
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #1e3a8a;
            height: 100vh;
            width: 100vw;
            display: flex;
            overflow: hidden;
        }

        /* ─── Layout ─── */
        .main-container {
            display: flex;
            width: 100%;
            height: 100%;
        }

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

        .right-side {
            background-color: white;
            flex: 1.2;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 80px;
            border-radius: 80px 0 0 80px;
            z-index: 10;
            box-shadow: -20px 0 50px rgba(0, 0, 0, 0.2);
        }

        /* ─── Auth Toggle ─── */
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
            transition: all 0.3s;
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

        /* ─── Form Elements ─── */
        label {
            display: block;
            font-weight: 700;
            font-size: 0.85rem;
            color: #1e3a8a;
            margin-bottom: 0.6rem;
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

        /* ─── Button ─── */
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

        /* ─── Illustration ─── */
        .illustration-img {
            width: 85%;
            max-width: 500px;
            filter: drop-shadow(0 30px 40px rgba(0, 0, 0, 0.4));
            animation: float 6s ease-in-out infinite;
        }

        /* ─── Animations ─── */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50%       { transform: translateY(-20px); }
        }

        @keyframes slideUp {
            from { bottom: -50px; opacity: 0; }
            to   { bottom: 30px; opacity: 1; }
        }
    </style>

    @stack('styles')
</head>
<body>
    <div class="main-container">

        {{-- Sisi Kiri: Ilustrasi & Branding --}}
        <div class="left-side">
            <div class="mb-10">
                <h1 class="text-4xl font-black tracking-tight mb-4">SIMPRESMA</h1>
                <div class="h-1.5 w-20 bg-yellow-400 mx-auto rounded-full"></div>
            </div>

            @yield('left_content')
        </div>

        {{-- Sisi Kanan: Form --}}
        <div class="right-side">
            <div class="w-full max-w-md">
                @yield('right_content')
            </div>
        </div>

    </div>

    {{-- Toast Notification --}}
    <script>
        function showToast(message) {
            const toast = document.createElement('div');
            toast.style.cssText = `
                position: fixed; bottom: 30px; left: 50%;
                transform: translateX(-50%);
                background: #1f2937; color: white;
                padding: 16px 30px; border-radius: 12px;
                font-weight: bold; font-size: 14px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.3);
                z-index: 9999; animation: slideUp 0.3s ease-out;
            `;
            toast.innerText = message;
            document.body.appendChild(toast);

            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transition = '0.5s';
                setTimeout(() => toast.remove(), 500);
            }, 3000);
        }
    </script>

    @stack('scripts')
</body>
</html>