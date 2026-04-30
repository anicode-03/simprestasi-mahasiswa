<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPRESMA | @yield('title', 'Beranda')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <style>
        /* 1. Import Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');

        /* 2. Global Styles */
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #ffffff;
        }

        /* 3. Utility Classes (Warna & Background) */
        .blue-main {
            color: #1e3a8a;
        }

        .bg-blue-main {
            background-color: #1e3a8a;
        }

        .border-blue-main {
            border-color: #1e3a8a;
        }

        .hero-pattern {
            background-color: #1e3a8a;
            background-image: radial-gradient(circle at 2px 2px, rgba(255, 255, 255, 0.05) 1px, transparent 0);
            background-size: 40px 40px;
        }

        /* 4. Layout & Spacing (Extend Left) */
        @media (min-width: 768px) {
            .extend-left {
                margin-left: -190px;
                position: relative;
                z-index: 5;
            }
        }

        /* 5. Navigation Styles */
        .nav-link {
            position: relative;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 50%;
            width: 0;
            height: 2px;
            background-color: white;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link.active {
            font-weight: 800 !important;
            color: white !important;
        }

        .nav-link.active::after {
            width: 100%;
        }

        .btn-nav-outline {
            border: 1.5px solid white;
            color: white;
        }

        .btn-nav-outline:hover {
            background-color: white;
            color: #1e3a8a;
        }

        /* 6. Cards & Components */
        .custom-shadow {
            box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.1);
        }

        .card-shadow {
            box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.05);
        }

        .border-gradient {
            border: 4px solid #1e3a8a;
            border-radius: 40px;
        }

        .card-prestasi {
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
        }

        .card-prestasi:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .contact-box {
            border: 2px solid #1e3a8a;
            border-radius: 20px;
            position: relative;
        }

        /* 7. Sliders & Pagination */
        .slider-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.4);
            color: #1e3a8a;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            z-index: 10;
            opacity: 0;
            backdrop-filter: blur(4px);
        }

        .group:hover .slider-btn,
        .relative:hover .slider-btn {
            opacity: 1;
        }

        .slider-btn:hover {
            background: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .swiper-pagination-bullet-active {
            background: #00c2cb !important;
        }

        /* 8. Tabs & Filtering Buttons */
        .cat-btn {
            color: #9ca3af;
        }

        .cat-btn:not(.tab-active):hover {
            color: #1e3a8a;
            background-color: #f8fafc;
        }

        .cat-btn.tab-active {
            background-color: #1e3a8a;
            color: white;
            cursor: default;
            pointer-events: none;
        }

        /* 9. Misc (Scrollbar & Modal) */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

    @include('layouts.navbar')
    @include('components.footer')
    @include('components.popup')
    @yield('content')

    <script src="{{ asset('assets/prestasi.js') }}"></script>
    {{-- <script src="{{ asset('assets/kategori.js') }}"></script> --}}

    @stack('scripts')
</body>

</html>
