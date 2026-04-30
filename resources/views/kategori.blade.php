@extends('layouts.app')

@section('content')
    <main class="flex-1 max-w-7xl mx-auto w-full px-4 py-12">

        <!-- Bagian Eksplorasi Pencapaian (Update Sesuai Permintaan) -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-5xl font-black uppercase tracking-tight mb-4">
                <span class="text-black">GALERI</span>
                <span class="text-[#1e3a8a]">PRESTASI</span>
            </h2>
            <p class="text-gray-500 max-w-2xl mx-auto text-sm leading-relaxed font-medium">Temukan inspirasi dari ribuan
                prestasi mahasiswa Politeknik Negeri Jember yang telah mengukir nama di kancah Nasional maupun
                Internasional.</p>

            <!-- Search Bar Baru -->
            <div class="mt-8 max-w-2xl mx-auto">
                <div
                    class="flex items-center bg-white border-2 border-gray-100 rounded-2xl px-6 py-4 transition-all duration-300 shadow-sm focus-within:border-[#1e3a8a] focus-within:shadow-md">
                    <i class="fas fa-search text-gray-400 mr-4"></i>
                    <input type="text" id="searchInput" onkeyup="filterItems()"
                        placeholder="Cari nama mahasiswa, judul prestasi, atau prodi..."
                        class="w-full bg-transparent outline-none text-sm font-regular text-gray-700">
                </div>
            </div>
        </div>

        <!-- Filter Bar Kategori -->
        <div class="flex flex-col items-center mt-4 mb-12">
            <div class="flex overflow-x-auto no-scrollbar max-w-full pb-4 px-2">
                <div class="flex space-x-2 bg-white p-2 rounded-2xl shadow-md border border-gray-50">
                    <button onclick="setCategory('Semua', this)"
                        class="cat-btn tab-active px-8 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">Semua</button>
                    <button onclick="setCategory('Jurusan', this)"
                        class="cat-btn px-8 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-[#1e3a8a] transition-all">Jurusan</button>
                    <button onclick="setCategory('UKM', this)"
                        class="cat-btn px-8 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-[#1e3a8a] transition-all">UKM</button>
                    <button onclick="setCategory('Akademik', this)"
                        class="cat-btn px-8 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-[#1e3a8a] transition-all">Akademik</button>
                    <button onclick="setCategory('Non-Akademik', this)"
                        class="cat-btn px-8 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest text-gray-400 hover:text-[#1e3a8a] transition-all">Non-Akademik</button>
                </div>
            </div>
            <div id="resultCount" class="text-[10px] font-black text-blue-400 uppercase tracking-[0.2em] mt-2">Menampilkan 0
                Prestasi</div>
        </div>

        {{-- GRID PRESTASI TERBARU --}}
        <div class="max-w-7xl mx-auto px-4 -mt-2">
            <div id="prestasiGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6"></div>
            @include('components.popup')
        </div>

        <div class="flex justify-between items-center mt-8">
            <button onclick="showAlert('Halaman Sebelumnya')"
                class="bg-[#00c2cb] text-white px-6 py-2 rounded-lg font-bold text-sm hover:opacity-90 transition shadow-md">
                Previous
            </button>
            <button onclick="showAlert('Halaman Berikutnya')"
                class="bg-[#3b82f6] text-white px-6 py-2 rounded-lg font-bold text-sm hover:opacity-90 transition shadow-md">
                Next
            </button>
        </div>
    </main>
@endsection
