@extends('layouts.app')

@section('content')

{{-- HERO --}}
<section class="hero-pattern py-16 md:py-28 relative">
    <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row items-center">
        <div class="md:w-1/2 flex justify-center mb-12 md:mb-0">
            <div class="relative">
                <img src="{{ asset('assets/img/hero.png') }}" class="w-full max-w-xxl drop-shadow-2xl rounded-3xl" alt="Piala Prestasi">
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
                    <input id="searchInput" type="text" placeholder="Masukkan NIM / Nama / Jurusan / Prodi" class="w-full px-5 py-4 rounded-l-md text-gray-800 focus:outline-none text-sm">
                    <button onclick="handleSearch()" class="bg-[#1e3a8a] hover:bg-blue-900 px-7 py-4 rounded-r-md transition-colors border-l border-blue-800">
                        <i class="fas fa-search text-white"></i>
                    </button>
                </div>
                <p class="mt-3 text-[10px] text-blue-300 font-medium">Keyword : NIM/Nama/Jurusan/Prodi</p>
            </div>
        </div>
    </div>
</section>
 
{{-- KATEGORI PRESTASI --}}
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
 
{{-- TAGLINE --}}
<section class="py-10 text-center px-4">
    <p class="text-xl font-extrabold text-gray-800 uppercase tracking-tighter">
        Catat Prestasimu, Banggakan <span class="text-[#1e3a8a]">POLIJE!</span>
    </p>
    <p class="text-black-500 mt-1 font-medium">Laporkan prestasi mahasiswa melalui Sistem Prestasi Mahasiswa <span class="font-bold text-gray-700">POLIJE.</span></p>
</section>
 
{{-- INFO CARDS --}}
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
 
{{-- TENTANG --}}
<section id="tentang" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="border-gradient p-10 md:p-14 relative bg-white flex flex-col items-center text-center">
            <div class="absolute -top-6 bg-white px-8">
                <p class="text-[30px] font-extrabold text-black-400 uppercase tracking-widest text-center">TENTANG</p>
                <h2 class="text-2xl font-black text-[#1e3a8a] tracking-tighter">SIMPRESMA-POLIJE</h2>
            </div>
 
            <img src="{{ asset('assets/img/tentangkami.png') }}" class="max-w-sm mb-5 mix-blend-multiply" alt="Simpresma Illustration">
 
            <div class="space-y-4 text-md text-[#1e3a8a] leading-relaxed font-medium max-w-6xl">
                <p>SIMPRESMA-POLIJE (Sistem Informasi Manajemen Prestasi Mahasiswa Politeknik Negeri Jember) merupakan platform digital yang dirancang untuk mendukung pengelolaan dan pendataan prestasi mahasiswa secara terintegrasi dan transparan. Sistem ini menjadi wadah resmi bagi mahasiswa POLIJE untuk melaporkan, mendokumentasikan, dan memantau capaian akademik maupun non-akademik.</p>
                <p>Melalui SIMPRESMA-POLIJE, setiap prestasi seperti kompetisi, sertifikasi, inovasi, penelitian, kegiatan Unit Kegiatan Mahasiswa (UKM), hingga penghargaan tingkat regional, nasional, maupun internasional dapat tercatat dengan baik. Data yang tersimpan akan membantu pihak kampus dalam proses validasi, pelaporan institusi, serta pengembangan budaya berprestasi di lingkungan POLIJE.</p>
                <p>SIMPRESMA-POLIJE hadir sebagai bentuk komitmen Politeknik Negeri Jember dalam mendukung mahasiswa vokasi yang kompeten, berdaya saing, dan unggul di berbagai bidang. Dengan sistem yang terstruktur dan mudah diakses, diharapkan setiap capaian mahasiswa dapat terdokumentasi secara optimal dan menjadi bagian dari kebanggaan bersama.</p>
            </div>
        </div>
    </div>
</section>
 
{{-- SLIDER QUOTE --}}
<section class="max-w-4xl mx-auto mb-24">
    <div class="text-center mb-10">
        <span class="bg-gray-100 text-gray-500 px-4 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest">Inspirasi Tokoh</span>
    </div>
 
    <div class="swiper quote-slider pb-12">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="bg-white p-10 rounded-[2rem] card-shadow text-center border border-gray-50">
                    <p class="text-xl md:text-2xl text-gray-700 italic leading-relaxed mb-8">
                        "Satu-satunya cara untuk melakukan pekerjaan hebat adalah dengan mencintai apa yang Anda lakukan. Teruslah berprestasi."</p>
                    <h4 class="font-bold text-lg text-gray-900">Steve Jobs</h4>
                    <p class="text-[#00c2cb] text-xs font-bold uppercase tracking-widest">Pendiri Apple Inc.</p>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="bg-white p-10 rounded-[2rem] card-shadow text-center border border-gray-50">
                    <p class="text-xl md:text-2xl text-gray-700 italic leading-relaxed mb-8">
                        "Pendidikan adalah senjata paling ampuh yang dapat Anda gunakan untuk mengubah dunia."
                    </p>
                    <h4 class="font-bold text-lg text-gray-900">Nelson Mandela</h4>
                    <p class="text-[#00c2cb] text-xs font-bold uppercase tracking-widest">Pejuang Kemanusiaan</p>
                </div>
            </div>
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
        <div class="swiper-pagination"></div>
    </div>
</section>
 
{{-- GRID PRESTASI TERBARU --}}
<div class="max-w-7xl mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold text-[#1e3a8a] mb-8 uppercase tracking-wider">Prestasi Terbaru</h2>
    <div id="prestasiGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6"></div>
    @include('components.popup')
</div>
 
{{-- TOMBOL LIHAT SEMUA --}}
<div class="flex justify-center mt-12 mb-16">
    <a href="{{ url('/kategori') }}" class="group flex items-center space-x-3 bg-white border-2 border-[#1e3a8a] text-[#1e3a8a] px-8 py-4 rounded-2xl font-bold uppercase tracking-widest text-xs hover:bg-[#1e3a8a] hover:text-white transition-all duration-300 shadow-lg hover:shadow-[#1e3a8a]/30">
        <span>Lihat Semua Prestasi</span>
        <i class="fas fa-arrow-right group-hover:translate-x-2 transition-transform"></i>
    </a>
</div>
 
@endsection