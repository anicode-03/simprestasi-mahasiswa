{{-- resources/views/admin/partials/tab-verifikasi.blade.php --}}
<section id="verifikasiTab" class="hidden space-y-8">
    <div class="flex items-center justify-between mb-2">
        <div>
            <h3 class="text-xl font-black text-slate-800">Menunggu Verifikasi</h3>
            <p class="text-sm text-slate-400 font-medium">Terdapat <span class="text-primary font-bold">12 pengajuan</span> prestasi baru mahasiswa.</p>
        </div>
        <div class="flex space-x-3">
            <button class="bg-white border border-slate-200 px-4 py-2 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-50 transition-all flex items-center space-x-2">
                <i class="fas fa-filter"></i> <span>Filter</span>
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-8">
        {{-- CARD VERIFIKASI 1 --}}
        <div class="bg-white border border-slate-100 rounded-[2.5rem] p-8 card-shadow relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-bl-[5rem] -mr-8 -mt-8"></div>
            <div class="flex flex-col lg:flex-row gap-10">
                <div class="flex flex-col items-center shrink-0 space-y-4">
                    <div class="w-44 h-56 bg-slate-100 rounded-3xl overflow-hidden border-4 border-white shadow-xl">
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Ani" class="w-full h-full object-cover" alt="Profile">
                    </div>
                    <span class="px-4 py-1.5 bg-amber-100 text-amber-600 text-[10px] font-black uppercase tracking-widest rounded-full">Pending</span>
                </div>
                <div class="flex-1">
                    <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 mb-6">
                        <div>
                            <h4 class="text-2xl font-black text-slate-800 mb-1">Ani Rizqi Ziarotus S.</h4>
                            <p class="text-primary font-bold tracking-wider text-sm">E41251131 <span class="mx-2 text-slate-300">|</span> Teknik Informatika</p>
                        </div>
                        <div class="bg-primary/5 px-6 py-3 rounded-2xl border border-primary/10">
                            <p class="text-[10px] font-black text-primary uppercase tracking-widest mb-1">Capaian Prestasi</p>
                            <h5 class="text-lg font-extrabold text-slate-800 leading-tight">Juara 1 Olimpiade Internasional 2025</h5>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100"><p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Peringkat</p><p class="text-xs font-extrabold text-slate-700">Juara 1</p></div>
                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100"><p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Kategori</p><p class="text-xs font-extrabold text-slate-700">Akademik</p></div>
                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100"><p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Tingkat</p><p class="text-xs font-extrabold text-slate-700">Internasional</p></div>
                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100"><p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Tanggal</p><p class="text-xs font-extrabold text-slate-700">23 Nov 2025</p></div>
                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100"><p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Lokasi</p><p class="text-xs font-extrabold text-slate-700">Yogyakarta</p></div>
                    </div>
                    <div class="flex flex-col md:flex-row gap-6 items-center">
                        <div class="flex-1 w-full bg-slate-100/50 p-4 rounded-2xl border border-dashed border-slate-300 flex items-center space-x-4">
                            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-slate-400 border"><i class="fas fa-university"></i></div>
                            <div><p class="text-[9px] font-black text-slate-400 uppercase">Penyelenggara</p><p class="text-sm font-bold text-slate-700">Tokyo University Science</p></div>
                        </div>
                    </div>
                </div>
                <div class="flex lg:flex-col justify-center gap-3 shrink-0">
                    <button onclick="verifikasiAction('setujui','Ani Rizqi Ziarotus S.')" class="btn-action bg-emerald-500 text-white w-full lg:w-40 py-4 rounded-2xl font-black text-xs shadow-lg shadow-emerald-500/20 uppercase tracking-widest">SETUJUI</button>
                    <button onclick="verifikasiAction('tolak','Ani Rizqi Ziarotus S.')" class="btn-action bg-rose-500 text-white w-full lg:w-40 py-4 rounded-2xl font-black text-xs shadow-lg shadow-rose-500/20 uppercase tracking-widest">TOLAK</button>
                    <button onclick="verifikasiAction('revisi','Ani Rizqi Ziarotus S.')" class="btn-action bg-slate-800 text-white w-full lg:w-40 py-4 rounded-2xl font-black text-xs shadow-lg shadow-slate-800/20 uppercase tracking-widest">REVISI</button>
                </div>
            </div>
        </div>

        {{-- CARD VERIFIKASI 2 --}}
        <div class="bg-white border border-slate-100 rounded-[2.5rem] p-8 card-shadow">
            <div class="flex flex-col lg:flex-row gap-10">
                <div class="flex flex-col items-center shrink-0 space-y-4">
                    <div class="w-44 h-56 bg-slate-100 rounded-3xl overflow-hidden border-4 border-white shadow-xl">
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Erix" class="w-full h-full object-cover" alt="Profile">
                    </div>
                    <span class="px-4 py-1.5 bg-amber-100 text-amber-600 text-[10px] font-black uppercase tracking-widest rounded-full">Pending</span>
                </div>
                <div class="flex-1">
                    <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 mb-6">
                        <div>
                            <h4 class="text-2xl font-black text-slate-800 mb-1">Erix Agung Wibowo</h4>
                            <p class="text-primary font-bold tracking-wider text-sm">E41251146 <span class="mx-2 text-slate-300">|</span> Teknologi Informasi</p>
                        </div>
                        <div class="bg-primary/5 px-6 py-3 rounded-2xl border border-primary/10">
                            <p class="text-[10px] font-black text-primary uppercase tracking-widest mb-1">Capaian Prestasi</p>
                            <h5 class="text-lg font-extrabold text-slate-800 leading-tight">Juara 2 Business Plan Competition</h5>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100"><p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Kategori</p><p class="text-xs font-extrabold text-slate-700">Wirausaha</p></div>
                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100"><p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Tingkat</p><p class="text-xs font-extrabold text-slate-700">Nasional</p></div>
                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100"><p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Peran</p><p class="text-xs font-extrabold text-slate-700">Anggota</p></div>
                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100"><p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Tanggal</p><p class="text-xs font-extrabold text-slate-700">10 Okt 2025</p></div>
                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100"><p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Lokasi</p><p class="text-xs font-extrabold text-slate-700">Yogyakarta</p></div>
                    </div>
                    <div class="flex flex-col md:flex-row gap-6 items-center">
                        <div class="flex-1 w-full bg-slate-100/50 p-4 rounded-2xl border border-dashed border-slate-300 flex items-center space-x-4">
                            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-slate-400 border shadow-sm"><i class="fas fa-university"></i></div>
                            <div><p class="text-[9px] font-black text-slate-400 uppercase">Penyelenggara</p><p class="text-sm font-bold text-slate-700">Universitas Gadjah Mada</p></div>
                        </div>
                    </div>
                </div>
                <div class="flex lg:flex-col justify-center gap-3 shrink-0">
                    <button onclick="verifikasiAction('setujui','Erix Agung Wibowo')" class="btn-action bg-emerald-500 text-white w-full lg:w-40 py-4 rounded-2xl font-black text-xs shadow-lg shadow-emerald-500/20 uppercase tracking-widest">SETUJUI</button>
                    <button onclick="verifikasiAction('tolak','Erix Agung Wibowo')" class="btn-action bg-rose-500 text-white w-full lg:w-40 py-4 rounded-2xl font-black text-xs shadow-lg shadow-rose-500/20 uppercase tracking-widest">TOLAK</button>
                    <button onclick="verifikasiAction('revisi','Erix Agung Wibowo')" class="btn-action bg-slate-800 text-white w-full lg:w-40 py-4 rounded-2xl font-black text-xs shadow-lg shadow-slate-800/20 uppercase tracking-widest">REVISI</button>
                </div>
            </div>
        </div>
    </div>
</section>