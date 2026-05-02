<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPRESMA POLIJE | Dashboard Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');

        :root {
            --primary: #1e3a8a;
            --primary-light: #3b82f6;
            --bg-main: #f8fafc;
            --sidebar-width: 280px;
            --card-border: 1px solid #e2e8f0;
            --card-radius: 40px;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-main);
            color: #1e293b;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            background-color: #1e3a8a;
        }

        .nav-link {
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link.active {
            background: white;
            color: #1e3a8a;
            border-radius: 30px 0 0 30px;
            font-weight: 700;
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            right: 0;
            top: -30px;
            width: 30px;
            height: 30px;
            background: transparent;
            border-radius: 50%;
            box-shadow: 15px 15px 0 white;
        }

        .nav-link.active::before {
            content: '';
            position: absolute;
            right: 0;
            bottom: -30px;
            width: 30px;
            height: 30px;
            background: transparent;
            border-radius: 50%;
            box-shadow: 15px -15px 0 white;
        }

        /* ===== UNIFIED CARD STYLE (mengikuti pengaturan) ===== */
        .card {
            background: #ffffff;
            border-radius: var(--card-radius);
            border: var(--card-border);
        }

        /* ===== PROFILE CARD ===== */
        .profile-card {
            background: #ffffff;
            border-radius: var(--card-radius);
            border: var(--card-border);
            margin-top: 100px;
            padding: 100px 40px 40px 40px;
            position: relative;
        }

        .profile-img-container {
            width: 180px;
            height: 180px;
            background: #e2e8f0;
            border-radius: 50%;
            position: absolute;
            top: -90px;
            left: 50%;
            transform: translateX(-50%);
            border: 8px solid white;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            align-items: flex-end;
            justify-content: center;
        }

        /* ===== ACHIEVEMENT CARD ===== */
        .achievement-card {
            background: #ffffff;
            border-radius: var(--card-radius);
            border: var(--card-border);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .podium-container {
            background: #f8fafc;
            border-radius: 24px;
            border: 1px solid #e2e8f0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 24px;
        }

        .scroll-area {
            max-height: calc(100vh - 450px);
            overflow-y: auto;
            padding-right: 10px;
        }

        .scroll-area::-webkit-scrollbar {
            width: 4px;
        }

        .scroll-area::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 10px;
        }

        /* ===== BADGE ===== */
        .badge-rank {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .badge-gold {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-silver {
            background: #f1f5f9;
            color: #475569;
        }

        .badge-bronze {
            background: #ffedd5;
            color: #9a3412;
        }

        /* ===== TOAST ===== */
        #toast-container {
            position: fixed;
            bottom: 28px;
            right: 28px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 10px;
            pointer-events: none;
        }

        .toast {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            border-radius: 16px;
            background: white;
            border: 1px solid #f1f5f9;
            font-size: 13px;
            font-weight: 600;
            color: #1e293b;
            pointer-events: all;
            min-width: 260px;
            max-width: 360px;
            animation: toastIn 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }

        .toast.removing {
            animation: toastOut 0.25s ease forwards;
        }

        .toast-icon {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            flex-shrink: 0;
        }

        .toast-success .toast-icon {
            background: #dcfce7;
            color: #16a34a;
        }

        .toast-error .toast-icon {
            background: #fee2e2;
            color: #dc2626;
        }

        .toast-info .toast-icon {
            background: #dbeafe;
            color: #2563eb;
        }

        .toast-warning .toast-icon {
            background: #fef3c7;
            color: #d97706;
        }

        @keyframes toastIn {
            from {
                opacity: 0;
                transform: translateX(30px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateX(0) scale(1);
            }
        }

        @keyframes toastOut {
            from {
                opacity: 1;
                transform: translateX(0) scale(1);
            }
            to {
                opacity: 0;
                transform: translateX(30px) scale(0.95);
            }
        }

        /* ===== FIELD ERROR ===== */
        .field-error {
            font-size: 11px;
            color: #dc2626;
            font-weight: 600;
            margin-top: 4px;
            margin-left: 4px;
            display: none;
        }

        .field-error.visible {
            display: block;
            animation: fadeSlideIn 0.2s ease;
        }

        input.input-error,
        select.input-error,
        textarea.input-error {
            border-color: #fca5a5 !important;
            background: #fff5f5 !important;
        }

        input.input-ok,
        select.input-ok,
        textarea.input-ok {
            border-color: #86efac !important;
        }

        /* ===== SPINNER ===== */
        .btn-spinner {
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255, 255, 255, 0.4);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
            display: none;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* ===== DRAG DROP ===== */
        .upload-zone.dragover {
            border-color: #3b82f6 !important;
            background: #eff6ff !important;
        }

        /* ===== CONFIRM MODAL ===== */
        #confirm-modal {
            position: fixed;
            inset: 0;
            z-index: 9998;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(15, 23, 42, 0.4);
            backdrop-filter: blur(4px);
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s ease;
        }

        #confirm-modal.open {
            opacity: 1;
            pointer-events: all;
        }

        #confirm-modal .modal-box {
            background: white;
            border-radius: 28px;
            padding: 32px;
            width: 360px;
            border: 1px solid #e2e8f0;
            transform: scale(0.95);
            transition: transform 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        #confirm-modal.open .modal-box {
            transform: scale(1);
        }

        /* ===== AVATAR MODAL ===== */
        #avatar-modal .modal-inner {
            background: white;
            border-radius: var(--card-radius);
            border: 1px solid #e2e8f0;
            width: 100%;
            max-width: 440px;
            overflow: hidden;
        }

        .avatar-btn-selected {
            border-color: #1e3a8a !important;
            box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.2);
        }

        /* ===== ANIMATIONS ===== */
        .section-transition {
            animation: fadeSlideIn 0.25s ease forwards;
        }

        @keyframes fadeSlideIn {
            from {
                opacity: 0;
                transform: translateY(8px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.5s ease-out forwards;
        }

        /* ===== PASSWORD STRENGTH ===== */
        #pw-strength-bar {
            height: 4px;
            border-radius: 4px;
            transition: width 0.3s ease, background 0.3s ease;
            width: 0%;
        }

        /* ===== SCROLL ===== */
        .custom-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scroll::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 10px;
        }
    </style>
</head>

<body class="flex min-h-screen">

    {{-- TOAST --}}
    @include('mahasiswa.partials.toast')

    {{-- CONFIRM MODAL --}}
    @include('mahasiswa.partials.confirm-modal')

    {{-- AVATAR MODAL --}}
    @include('mahasiswa.partials.avatar')

    {{-- SIDEBAR --}}
    @include('mahasiswa.partials.sidebar')

    <!-- MAIN CONTENT -->
    <main class="ml-[5px] flex-1 p-10 h-screen flex flex-col gap-8 min-h-0">

        {{-- HEADER --}}
        @include('mahasiswa.partials.header')

        {{-- SECTIONS --}}
        @yield('sections')

    </main>

    {{-- SCRIPTS --}}
    @include('mahasiswa.partials.scripts')

</body>

</html>