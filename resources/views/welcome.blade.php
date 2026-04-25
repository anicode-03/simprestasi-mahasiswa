<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPRESMA POLIJE | Beranda</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');

        html {
            scroll-behavior: smooth;
        }

        .nav-link {
            position: relative;
            transition: all 0.3s ease;
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
            /* Font jadi lebih tebal */
            color: white !important;
        }

        .nav-link.active::after {
            width: 100%;
            /* Garis muncul penuh */
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .hero-pattern {
            background-color: #1e3a8a;
            background-image: radial-gradient(circle at 2px 2px, rgba(255, 255, 255, 0.05) 1px, transparent 0);
            background-size: 40px 40px;
        }

        .custom-shadow {
            box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.1);
        }

        .border-gradient {
            border: 4px solid #1e3a8a;
            border-radius: 40px;
        }

        /* Update styling tombol outline untuk navbar biru */
        .btn-nav-outline {
            border: 1.5px solid white;
            color: white;
        }

        .btn-nav-outline:hover {
            background-color: white;
            color: #1e3a8a;
        }

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

        .group:hover .slider-btn {
            opacity: 1;
        }

        .slider-btn:hover {
            background: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .swiper-pagination-bullet-active {
            background: #00c2cb !important;
        }

        .card-shadow {
            box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.05);
        }

        /* Navigasi Slider */
        .slider-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            /* Ganti bg-white/rgba di sini */
            background: rgba(255, 255, 255, 0.4);
            /* Angka 0.4 adalah tingkat transparansi */
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
            /* Efek kaca transparan */
        }

        .group:hover .slider-btn,
        .relative:hover .slider-btn {
            opacity: 1;
        }

        .slider-btn:hover {
            background: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">
    <nav class="bg-[#1e3a8a] sticky top-0 z-50 shadow-sm border-b border-blue-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center space-x-3">
                    <img src="asset/img/logo.png" class="w-10 h-10" alt="Logo">
                    <span class="font-extrabold text-xl text-white tracking-tight">SIMPRESMA - POLIJE</span>
                </div>

                <div class="hidden md:flex items-center space-x-10">
                    <a href="#" class="nav-link active text-white font-bold text-xs tracking-widest py-1">BERANDA</a>
                    <a href="#tentang" class="nav-link text-blue-100 hover:text-white font-bold text-xs tracking-widest transition-all">TENTANG SIMPRESMA-POLIJE</a>
                    <a href="kontak.php" class="nav-link text-blue-100 hover:text-white font-bold text-xs tracking-widest transition-all">KONTAK</a>

                    @guest
                    <div class="flex items-center -space-x-1 ml-4">
                        <a href="{{ route('login') }}" class="px-4 py-1.5 text-xs font-bold btn-nav-outline rounded transition-all inline-block">LOGIN</a>
                        <a href="{{ route('register') }}" class="px-4 py-1.5 text-xs font-bold btn-nav-outline bg-white text-[#1e3a8a] rounded hover:bg-blue-50 transition-all inline-block">SIGN UP</a>
                    </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <section class="hero-pattern py-16 md:py-28 relative">
        <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 flex justify-center mb-12 md:mb-0">
                <div class="relative">
                    <img src="asset/img/hero.png" class="w-full max-w-xxl drop-shadow-2xl rounded-3xl" alt="Piala Prestasi">
                </div>
            </div>

            <div class="md:w-1/2 text-white text-center md:text-left">
                <h1 class="text-4xl md:text-5xl font-regular leading-[1.15] mb-6">
                    Sistem Informasi Manajemen Prestasi Mahasiswa
                </h1>
                <p class="text-lg text-blue-100/90 mb-8 font-light leading-relaxed">
                    Selamat datang di SIMPRESMA-POLIJE.<br>
                    Pangkalan Data Prestasi Mahasiswa Politeknik Negeri Jember.
                </p>

                <div class="max-w-xl">
                    <p class="mb-3 text-sm font-semibold text-blue-200">Cek Portofolio Prestasi Kamu</p>
                    <div class="flex shadow-2xl">
                        <input type="text" placeholder="Masukkan NIM / Nama / Jurusan / Prodi" class="w-full px-5 py-4 rounded-l-md text-gray-800 focus:outline-none text-sm">
                        <button class="bg-[#1e3a8a] hover:bg-blue-900 px-7 py-4 rounded-r-md transition-colors border-l border-blue-800">
                            <i class="fas fa-search text-white"></i>
                        </button>
                    </div>
                    <p class="mt-3 text-[10px] text-blue-300 font-medium">Keyword : NIM/Nama/Jurusan/Prodi</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-2xl font-extrabold text-center text-gray-800 mb-10">Kategori Prestasi</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="#" class="flex items-center justify-center space-x-3 bg-[#1e3a8a] text-white py-4 px-6 rounded-lg hover:shadow-xl hover:-translate-y-1 transition-all">
                    <i class="fas fa-users text-lg"></i>
                    <span class="font-bold text-sm tracking-wide">Prestasi UKM</span>
                </a>
                <a href="#" class="flex items-center justify-center space-x-3 bg-[#1e3a8a] text-white py-4 px-6 rounded-lg hover:shadow-xl hover:-translate-y-1 transition-all">
                    <i class="fas fa-university text-lg"></i>
                    <span class="font-bold text-sm tracking-wide">Prestasi Jurusan</span>
                </a>
                <a href="#" class="flex items-center justify-center space-x-3 bg-[#1e3a8a] text-white py-4 px-6 rounded-lg hover:shadow-xl hover:-translate-y-1 transition-all">
                    <i class="fas fa-graduation-cap text-lg"></i>
                    <span class="font-bold text-sm tracking-wide">Prestasi Akademik</span>
                </a>
                <a href="#" class="flex items-center justify-center space-x-3 bg-[#1e3a8a] text-white py-4 px-6 rounded-lg hover:shadow-xl hover:-translate-y-1 transition-all">
                    <i class="fas fa-trophy text-lg"></i>
                    <span class="font-bold text-sm tracking-wide">Prestasi Non-Akademik</span>
                </a>
            </div>
        </div>
    </section>

    <section class="py-10 text-center px-4">
        <p class="text-xl font-extrabold text-gray-800 uppercase tracking-tighter">
            Catat Prestasimu, Banggakan <span class="text-[#1e3a8a]">POLIJE!</span>
        </p>
        <p class="text-black-500 mt-1 font-medium">Laporkan prestasi mahasiswa melalui Sistem Prestasi Mahasiswa <span class="font-bold text-gray-700">POLIJE.</span></p>
    </section>

    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-[#3b82f6] text-white p-10 rounded-2xl text-center shadow-lg hover:shadow-blue-200 transition-all flex flex-col items-center">
                <i class="fas fa-trophy text-5xl mb-6"></i>
                <h3 class="font-bold text-lg leading-tight mb-4">Laporkan Prestasimu Secara Aktif</h3>
                <p class="text-xs text-blue-50 leading-relaxed font-medium">Mahasiswa POLIJE diharapkan secara mandiri melaporkan setiap capaian akademik maupun non-akademik melalui SIMPRESMA-POLIJE sebagai bagian dari budaya kampus berprestasi.</p>
            </div>
            <div class="bg-[#4f46e5] text-white p-10 rounded-2xl text-center shadow-lg hover:shadow-indigo-200 transition-all flex flex-col items-center">
                <i class="fas fa-file-contract text-5xl mb-6"></i>
                <h3 class="font-bold text-lg leading-tight mb-4">Unggah Bukti Resmi</h3>
                <p class="text-xs text-blue-50 leading-relaxed font-medium">Lampirkan dokumen resmi seperti sertifikat, surat keputusan, atau dokumentasi lomba yang diterbitkan oleh penyelenggara dan dapat diverifikasi.</p>
            </div>
            <div class="bg-[#0d9488] text-white p-10 rounded-2xl text-center shadow-lg hover:shadow-teal-200 transition-all flex flex-col items-center">
                <i class="fas fa-edit text-5xl mb-6"></i>
                <h3 class="font-bold text-lg leading-tight mb-4">Lengkapi Informasi Kegiatan</h3>
                <p class="text-xs text-blue-50 leading-relaxed font-medium">Isi detail kegiatan secara lengkap dan jelas, meliputi nama kegiatan, penyelenggara, tingkat kompetisi, serta capaian atau peringkat yang diperoleh agar data dapat divalidasi dengan tepat.</p>
            </div>
            <div class="bg-[#0ea5e9] text-white p-10 rounded-2xl text-center shadow-lg hover:shadow-sky-200 transition-all flex flex-col items-center">
                <i class="fas fa-hourglass-start text-5xl mb-6"></i>
                <h3 class="font-bold text-lg leading-tight mb-4">Monitoring Status Pengajuan</h3>
                <p class="text-xs text-blue-50 leading-relaxed font-medium">Pantau secara berkala status pengajuan melalui dashboard SIMPRESMA-POLIJE. Segera lakukan perbaikan apabila terdapat catatan revisi dari admin atau validator agar proses validasi tidak tertunda.</p>
            </div>
        </div>
    </section>

    <section id="tentang" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="border-gradient p-10 md:p-14 relative bg-white flex flex-col items-center text-center">
                <div class="absolute -top-6 bg-white px-8">
                    <p class="text-[30px] font-extrabold text-black-400 uppercase tracking-widest text-center">TENTANG</p>
                    <h2 class="text-2xl font-black text-[#1e3a8a] tracking-tighter">SIMPRESMA-POLIJE</h2>
                </div>

                <img src="asset/img/tentangkami.png" class="max-w-sm mb-5 mix-blend-multiply" alt="Simpresma Illustration">

                <div class="space-y-4 text-md text-[#1e3a8a] leading-relaxed font-medium max-w-6xl">
                    <p>SIMPRESMA-POLIJE (Sistem Informasi Manajemen Prestasi Mahasiswa Politeknik Negeri Jember) merupakan platform digital yang dirancang untuk mendukung pengelolaan dan pendataan prestasi mahasiswa secara terintegrasi dan transparan. Sistem ini menjadi wadah resmi bagi mahasiswa POLIJE untuk melaporkan, mendokumentasikan, dan memantau capaian akademik maupun non-akademik.</p>
                    <p>Melalui SIMPRESMA-POLIJE, setiap prestasi seperti kompetisi, sertifikasi, inovasi, penelitian, kegiatan Unit Kegiatan Mahasiswa (UKM), hingga penghargaan tingkat regional, nasional, maupun internasional dapat tercatat dengan baik. Data yang tersimpan akan membantu pihak kampus dalam proses validasi, pelaporan institusi, serta pengembangan budaya berprestasi di lingkungan POLIJE.</p>
                    <p>SIMPRESMA-POLIJE hadir sebagai bentuk komitmen Politeknik Negeri Jember dalam mendukung mahasiswa vokasi yang kompeten, berdaya saing, dan unggul di berbagai bidang. Dengan sistem yang terstruktur dan mudah diakses, diharapkan setiap capaian mahasiswa dapat terdokumentasi secara optimal dan menjadi bagian dari kebanggaan bersama.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SLIDER QUOTE TOKOH DUNIA -->
    <section class="max-w-4xl mx-auto mb-24">
        <div class="text-center mb-10">
            <span class="bg-gray-100 text-gray-500 px-4 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest">Inspirasi Tokoh</span>
        </div>

        <div class="swiper quote-slider pb-12">
            <div class="swiper-wrapper">
                <!-- Slide 1: Steve Jobs -->
                <div class="swiper-slide">
                    <div class="bg-white p-10 rounded-[2rem] card-shadow text-center border border-gray-50">
                        <p class="text-xl md:text-2xl text-gray-700 italic leading-relaxed mb-8">
                            "Satu-satunya cara untuk melakukan pekerjaan hebat adalah dengan mencintai apa yang Anda lakukan. Teruslah berprestasi."</p>
                        <h4 class="font-bold text-lg text-gray-900">Steve Jobs</h4>
                        <p class="text-[#00c2cb] text-xs font-bold uppercase tracking-widest">Pendiri Apple Inc.</p>
                    </div>
                </div>
                <!-- Slide 2: Nelson Mandela -->
                <div class="swiper-slide">
                    <div class="bg-white p-10 rounded-[2rem] card-shadow text-center border border-gray-50">
                        <p class="text-xl md:text-2xl text-gray-700 italic leading-relaxed mb-8">
                            "Pendidikan adalah senjata paling ampuh yang dapat Anda gunakan untuk mengubah dunia."
                        </p>
                        <h4 class="font-bold text-lg text-gray-900">Nelson Mandela</h4>
                        <p class="text-[#00c2cb] text-xs font-bold uppercase tracking-widest">Pejuang Kemanusiaan</p>
                    </div>
                </div>
                <!-- Slide 3: Albert Einstein -->
                <div class="swiper-slide">
                    <div class="bg-white p-10 rounded-[2rem] card-shadow text-center border border-gray-50">
                        <p class="text-xl md:text-2xl text-gray-700 italic leading-relaxed mb-8">
                            "Cobalah untuk tidak menjadi orang yang sukses, tetapi cobalah untuk menjadi orang yang bernilai."
                        </p>
                        <h4 class="font-bold text-lg text-gray-900">Albert Einstein</h4>
                        <p class="text-[#00c2cb] text-xs font-bold uppercase tracking-widest">Fisikawan Teoretis</p>
                    </div>
                </div>
            </div>
            <!-- Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold text-[#1e3a8a] mb-8 uppercase tracking-wider">Prestasi Terbaru</h2>

        <div id="prestasiGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        </div>
    </div>

    <!-- Tombol Lihat Selengkapnya -->
    <div class="flex justify-center mt-12 mb-16">
        <a href="kategori.php" class="group flex items-center space-x-3 bg-white border-2 border-[#1e3a8a] text-[#1e3a8a] px-8 py-4 rounded-2xl font-bold uppercase tracking-widest text-xs hover:bg-[#1e3a8a] hover:text-white transition-all duration-300 shadow-lg hover:shadow-[#1e3a8a]/30">
            <span>Lihat Semua Prestasi</span>
            <i class="fas fa-arrow-right group-hover:translate-x-2 transition-transform"></i>
        </a>
    </div>

    <footer class="bg-[#1e3a8a] text-white pt-20 pb-10">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-12 gap-12 pb-16 border-b border-white/10">
            <div class="md:col-span-5">
                <h4 class="font-bold mb-6 text-sm tracking-widest">SIMPRESMA-POLIJE</h4>
                <p class="text-xs text-blue-200/80 leading-relaxed mb-8 max-w-sm">Website Resmi Untuk Pusat Data Prestasi Mahasiswa <br>Politeknik Negeri Jember.</p>
                <div class="flex items-center space-x-4">
                    <img src="asset/img/polije1.png" class="w-30 h-14 p-1" alt="Polije Logo">
                </div>
            </div>

            <div class="md:col-span-3">
                <h4 class="font-bold mb-6 text-sm tracking-widest uppercase">LINK TERKAIT</h4>
                <ul class="space-y-4 text-xs text-blue-100 font-medium">
                    <li><a href="#" class="hover:text-white transition-all">Web POLIJE</a></li>
                    <li><a href="#" class="hover:text-white transition-all">E-Brosur</a></li>
                </ul>
            </div>

            <div class="md:col-span-4">
                <h4 class="font-bold mb-6 text-sm tracking-widest uppercase">KONTAK</h4>
                <ul class="space-y-4 text-xs text-blue-100 font-medium">
                    <li class="flex items-start space-x-3">
                        <i class="fas fa-map-marker-alt mt-1"></i>
                        <span class="leading-relaxed">Jl. Mastrip PO BOX 164, Jember,<br>Jawa Timur, Indonesia</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <i class="fas fa-phone-alt"></i>
                        <span>+62 851 7959 0160</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <i class="fab fa-instagram text-lg"></i>
                        <span>@humaspolije</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <i class="fas fa-envelope"></i>
                        <span>politeknik@polije.ac.id</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="text-center pt-8 text-[10px] font-bold text-blue-400/60 uppercase tracking-widest">
            Copyright © 2026 Arendelle Team
        </div>
    </footer>

    <div id="popupContainer" class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="closePopup()"></div>

        <div id="popupContent" class="relative bg-white w-full max-w-4xl max-h-[90vh] rounded-3xl shadow-2xl overflow-y-auto no-scrollbar opacity-0 scale-95 transition-all duration-300">
            <button onclick="closePopup()" class="absolute top-5 right-5 z-20 bg-white/80 hover:bg-red-500 hover:text-white w-10 h-10 flex items-center justify-center rounded-full shadow-lg transition-all">
                <i class="fa fa-times"></i>
            </button>

            <div class="p-0">
                <div class="h-64 md:h-80 w-full relative group bg-gray-900">
                    <button onclick="changePopImg(-1)" class="slider-btn left-5 scale-125 z-30">
                        <i class="fa fa-chevron-left text-sm"></i>
                    </button>
                    <button onclick="changePopImg(1)" class="slider-btn right-5 scale-125 z-30">
                        <i class="fa fa-chevron-right text-sm"></i>
                    </button>

                    <img id="popImg" src="" class="w-full h-full object-cover transition-all duration-500" alt="Banner">

                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent pointer-events-none z-10"></div>

                    <div class="absolute bottom-6 left-8 right-8 z-20 pointer-events-none">
                        <div class="flex gap-2 mb-3">
                            <span id="popCapaian" class="bg-yellow-400 text-blue-900 text-[10px] font-black px-4 py-1 rounded-full uppercase tracking-widest shadow-lg"></span>
                            <span id="popTingkat" class="bg-blue-600 text-white text-[10px] font-black px-4 py-1 rounded-full uppercase tracking-widest shadow-lg"></span>
                        </div>
                        <h2 id="popTitle" class="text-2xl md:text-3xl font-black text-white uppercase tracking-tight leading-tight"></h2>
                    </div>
                </div>

                <div class="p-8 md:p-10">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100">
                            <h3 class="font-black text-blue-900 text-xs uppercase tracking-widest mb-6 border-b border-blue-100 pb-2">
                                <i class="fa fa-id-card mr-2"></i> Identitas Peserta
                            </h3>
                            <div class="space-y-5">
                                <div><label class="text-[10px] text-gray-400 font-bold uppercase block mb-1">Nama Lengkap</label>
                                    <p id="popNama" class="font-bold text-gray-800 text-sm"></p>
                                </div>
                                <div><label class="text-[10px] text-gray-400 font-bold uppercase block mb-1">NIM / ID Mahasiswa</label>
                                    <p id="popNim" class="font-bold text-gray-800 text-sm"></p>
                                </div>
                                <div><label class="text-[10px] text-gray-400 font-bold uppercase block mb-1">Program Studi</label>
                                    <p id="popProdi" class="font-bold text-gray-800 text-sm"></p>
                                </div>
                                <div><label class="text-[10px] text-gray-400 font-bold uppercase block mb-1">Dosen Pembimbing</label>
                                    <p id="popPembimbing" class="font-bold text-blue-700 text-sm"></p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100">
                            <h3 class="font-black text-blue-900 text-xs uppercase tracking-widest mb-6 border-b border-blue-100 pb-2">
                                <i class="fa fa-trophy mr-2"></i> Detail Kompetisi
                            </h3>
                            <div class="space-y-5">
                                <div><label class="text-[10px] text-gray-400 font-bold uppercase block mb-1">Penyelenggara</label>
                                    <p id="popPenyelenggara" class="font-bold text-gray-800 text-sm"></p>
                                </div>
                                <div><label class="text-[10px] text-gray-400 font-bold uppercase block mb-1">Tanggal Perolehan</label>
                                    <p id="popTanggal" class="font-bold text-gray-800 text-sm"></p>
                                </div>
                                <div><label class="text-[10px] text-gray-400 font-bold uppercase block mb-1">Lokasi / Tempat</label>
                                    <p id="popTempat" class="font-bold text-gray-800 text-sm"></p>
                                </div>
                                <div><label class="text-[10px] text-gray-400 font-bold uppercase block mb-1">Status Sertifikat</label><span class="inline-flex items-center text-[10px] font-bold text-green-600 bg-green-100 px-2 py-0.5 rounded"><i class="fa fa-check-circle mr-1"></i> Terverifikasi</span></div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h3 class="font-black text-gray-800 text-xs uppercase tracking-widest mb-4">Ringkasan Kegiatan</h3>
                        <p class="text-gray-600 text-sm leading-relaxed text-justify bg-white border border-gray-100 p-6 rounded-2xl">
                            Pencapaian ini merupakan hasil kerja keras mahasiswa yang bersangkutan di bawah bimbingan dosen terkait. Kompetisi ini diikuti oleh berbagai institusi ternama dan melalui proses seleksi yang ketat.
                        </p>
                    </div>

                    <div class="mt-10 flex flex-col md:flex-row justify-center gap-4">
                        <button class="px-8 py-3 bg-[#1e3a8a] text-white font-bold rounded-xl hover:bg-black transition-all shadow-lg flex items-center justify-center">
                            <i class="fa fa-download mr-2"></i> Unduh Sertifikat
                        </button>
                        <button onclick="closePopup()" class="px-8 py-3 bg-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-300 transition-all">Kembali</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const dataPrestasi = [{
                id: 1,
                nama: "Ani Rizqi Ziarotus S.",
                nim: "E41220001",
                prodi: "Teknologi Informasi",
                judul: "Teknologi dan Inovasi Digital",
                capaian: "Juara 1",
                tingkat: "Nasional",
                penyelenggara: "Kemdikbud Ristek",
                pembimbing: "Bapak Cahyo, S.Kom., M.T.",
                tanggal: "12 Maret 2024",
                tempat: "Jakarta, Indonesia",
                images: [
                    "https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=400",
                    "https://images.unsplash.com/photo-1567427017947-545c5f8d16ad?w=400",
                    "https://images.unsplash.com/photo-1589330694653-ded6df03f754?w=400"
                ]
            },
            {
                id: 2,
                nama: "Fikriyah Imtiyaz",
                nim: "E41220002",
                prodi: "Teknologi Informasi",
                judul: "Pengembangan Smart City",
                capaian: "Juara 1",
                tingkat: "Internasional",
                penyelenggara: "Komnas HAM",
                pembimbing: "Ibu Siti, S.Kom., M.T.",
                tanggal: "16 September 2026",
                tempat: "Berlin, Jerman",
                images: [
                    "https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=400",
                    "https://images.unsplash.com/photo-1567427017947-545c5f8d16ad?w=400",
                    "https://images.unsplash.com/photo-1589330694653-ded6df03f754?w=400"
                ]
            },
            {
                id: 3,
                nama: "Erix Agung W.",
                nim: "E41220003",
                prodi: "Teknik Komputer",
                judul: "Keamanan Jaringan Lanjutan",
                capaian: "Juara 2",
                tingkat: "Nasional",
                penyelenggara: "BSSN",
                pembimbing: "Bapak Ahmad, S.T., M.T.",
                tanggal: "20 Mei 2026",
                tempat: "Surabaya, Indonesia",
                images: [
                    "https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=400",
                    "https://images.unsplash.com/photo-1567427017947-545c5f8d16ad?w=400",
                    "https://images.unsplash.com/photo-1589330694653-ded6df03f754?w=400"
                ]
            },
            {
                id: 4,
                nama: "Falih Rahmatullah",
                nim: "E41220004",
                prodi: "Manajemen Informatika",
                judul: "Inovasi Mobile Apps",
                capaian: "Juara 3",
                tingkat: "Provinsi",
                penyelenggara: "Diskominfo",
                pembimbing: "Ibu Maya, M.Kom.",
                tanggal: "10 Juni 2026",
                tempat: "Jember, Indonesia",
                images: [
                    "https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=400",
                    "https://images.unsplash.com/photo-1567427017947-545c5f8d16ad?w=400",
                    "https://images.unsplash.com/photo-1589330694653-ded6df03f754?w=400"
                ],
            },
            {
                id: 5,
                nama: "Rizky Ramadhan",
                nim: "E31220105",
                prodi: "Manajemen Agribisnis",
                judul: "Inovasi Rantai Pasok Kopi Organik",
                capaian: "Juara 1",
                tingkat: "Nasional",
                penyelenggara: "IPB University",
                pembimbing: "Bapak Eko, S.P., M.P.",
                tanggal: "15 Agustus 2026",
                tempat: "Bogor, Indonesia",
                images: [
                    "https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?w=400",
                    "https://images.unsplash.com/photo-1567427017947-545c5f8d16ad?w=400",
                    "https://images.unsplash.com/photo-1589330694653-ded6df03f754?w=400"
                ]
            },
            {
                id: 6,
                nama: "Siti Aminah",
                nim: "C41220056",
                prodi: "Teknik Produksi Benih",
                judul: "Kultivasi Benih Unggul Padi Hybrid",
                capaian: "Juara 2",
                tingkat: "Regional",
                penyelenggara: "Balitpa",
                pembimbing: "Ibu Dian, S.P., M.Si.",
                tanggal: "03 September 2026",
                tempat: "Subang, Indonesia",
                images: [
                    "https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=400",
                    "https://images.unsplash.com/photo-1567427017947-545c5f8d16ad?w=400",
                    "https://images.unsplash.com/photo-1589330694653-ded6df03f754?w=400"
                ]
            },
            {
                id: 7,
                nama: "Budi Santoso",
                nim: "B31220087",
                prodi: "Produksi Tanaman Hortikultura",
                judul: "Hidroponik Presisi Skala Industri",
                capaian: "Juara Harapan 1",
                tingkat: "Nasional",
                penyelenggara: "Kementerian Pertanian",
                pembimbing: "Bapak Yoga, M.P.",
                tanggal: "22 Juli 2026",
                tempat: "Yogyakarta, Indonesia",
                images: [
                    "https://images.unsplash.com/photo-1485827404703-89b55fcc595e?w=400",
                    "https://images.unsplash.com/photo-1567427017947-545c5f8d16ad?w=400",
                    "https://images.unsplash.com/photo-1589330694653-ded6df03f754?w=400"
                ]
            },
            {
                id: 8,
                nama: "Dewi Lestari",
                nim: "D41220012",
                prodi: "Gizi Klinik",
                judul: "Formulasi Pangan Fungsional Lansia",
                capaian: "Juara 3",
                tingkat: "Internasional",
                penyelenggara: "SEAMEO RECFON",
                pembimbing: "Ibu Sari, S.Gz., M.Gizi.",
                tanggal: "12 Oktober 2026",
                tempat: "Jakarta, Indonesia",
                images: [
                    "https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=400",
                    "https://images.unsplash.com/photo-1567427017947-545c5f8d16ad?w=400",
                    "https://images.unsplash.com/photo-1589330694653-ded6df03f754?w=400"
                ]
            }
        ];

        function renderCards(filter = "") {
            const grid = document.getElementById('prestasiGrid');
            grid.innerHTML = '';

            const filtered = dataPrestasi.filter(item =>
                item.nama.toLowerCase().includes(filter.toLowerCase()) ||
                item.judul.toLowerCase().includes(filter.toLowerCase()) ||
                item.nim.toLowerCase().includes(filter.toLowerCase())
            );

            filtered.forEach(item => {
                grid.innerHTML += `
    <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 group flex flex-col h-full">
        <div class="h-52 bg-gray-200 relative overflow-hidden">
            <button onclick="event.stopPropagation(); changeImg(${item.id}, -1)" class="slider-btn left-3">
                <i class="fa fa-chevron-left text-[10px]"></i>
            </button>
            <button onclick="event.stopPropagation(); changeImg(${item.id}, 1)" class="slider-btn right-3">
                <i class="fa fa-chevron-right text-[10px]"></i>
            </button>
            <img id="img-card-${item.id}" src="${item.images[0]}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
            <div class="absolute top-3 left-3 z-10">
                <span class="bg-white/90 backdrop-blur-sm text-[#1e3a8a] text-[9px] font-black px-3 py-1 rounded-full uppercase tracking-tighter shadow-sm">
                    ${item.capaian}
                </span>
            </div>
        </div>

        <div class="p-5 flex flex-col flex-1">
            <div class="mb-4">
                <h3 class="font-extrabold text-[#1e3a8a] text-sm mb-1 uppercase line-clamp-1">${item.nama}</h3>
                <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">${item.prodi}</p>
            </div>
            <div class="space-y-2 mb-6 flex-1">
                <h4 class="font-bold text-gray-800 text-xs leading-snug line-clamp-2 uppercase">${item.judul}</h4>
                <div class="flex items-center text-[10px] text-gray-400 font-medium">
                    <i class="fas fa-university mr-1.5"></i>
                    <span class="truncate">${item.penyelenggara}</span>
                </div>
            </div>
            <button onclick='openPopup(${JSON.stringify(item)})' class="w-full bg-[#1e3a8a] text-white py-3 rounded-xl text-[10px] font-bold uppercase tracking-[0.2em] hover:bg-black transition-all shadow-lg">
                Lihat Detail
            </button>
        </div>
    </div>`;
            });
        }
        // Ambil semua elemen dengan class nav-link
        const navLinks = document.querySelectorAll('.nav-link');

        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                // Hapus class 'active' dari semua link
                navLinks.forEach(item => {
                    item.classList.remove('active', 'text-white');
                    item.classList.add('text-blue-100');
                });

                // Tambahkan class 'active' ke link yang diklik
                this.classList.add('active', 'text-white');
                this.classList.remove('text-blue-100');
            });
        });

        let currentImgIndex = 0;
        let currentPopItem = null;

        // Ganti gambar di card
        function changeImg(id, direction) {
            const item = dataPrestasi.find(p => p.id === id);
            const imgElement = document.getElementById(`img-card-${id}`);

            // Ambil URL gambar saat ini dari elemen img
            let currentSrc = imgElement.getAttribute('src');
            let idx = item.images.indexOf(currentSrc);

            // Hitung index selanjutnya
            idx = (idx + direction + item.images.length) % item.images.length;
            imgElement.src = item.images[idx];
        }

        // Buka popup detail
        function openPopup(item) {
            currentPopItem = item;
            currentImgIndex = 0;
            const popup = document.getElementById('popupContainer');
            const content = document.getElementById('popupContent');

            document.getElementById('popImg').src = item.images[0];
            document.getElementById('popTitle').innerText = item.judul;
            document.getElementById('popNama').innerText = item.nama;
            document.getElementById('popNim').innerText = item.nim;
            document.getElementById('popProdi').innerText = item.prodi;
            document.getElementById('popCapaian').innerText = item.capaian;
            document.getElementById('popTingkat').innerText = item.tingkat;
            document.getElementById('popPenyelenggara').innerText = item.penyelenggara;
            document.getElementById('popPembimbing').innerText = item.pembimbing;
            document.getElementById('popTanggal').innerText = item.tanggal;
            document.getElementById('popTempat').innerText = item.tempat;

            popup.classList.remove('hidden');
            popup.classList.add('flex');
            setTimeout(() => {
                content.classList.remove('opacity-0', 'scale-95');
                content.classList.add('opacity-100', 'scale-100');
            }, 10);
            document.body.style.overflow = 'hidden';
        }

        // Ganti gambar di dalam popup
        function changePopImg(direction) {
            if (!currentPopItem) return;
            currentImgIndex = (currentImgIndex + direction + currentPopItem.images.length) % currentPopItem.images.length;
            document.getElementById('popImg').src = currentPopItem.images[currentImgIndex];
        }

        // Fungsi tutup popup
        function closePopup() {
            const popup = document.getElementById('popupContainer');
            const content = document.getElementById('popupContent');
            content.classList.add('opacity-0', 'scale-95');
            setTimeout(() => {
                popup.classList.add('hidden');
                popup.classList.remove('flex');
                document.body.style.overflow = 'auto';
            }, 300);
        }

        function handleSearch() {
            const query = document.getElementById('searchInput').value;
            renderCards(query);
        }

        // Opsional: Agar bisa pencarian jalan saat tekan tombol Enter
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') handleSearch();
            });
        }

        // Panggil fungsi render agar data muncul saat pertama kali buka
        renderCards();

        // Aktivasi Slider Quote
        window.onload = () => {
            new Swiper('.quote-slider', {
                loop: true,
                autoplay: {
                    delay: 4000
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true
                },
                spaceBetween: 30,
            });
        };
    </script>

</body>

</html>