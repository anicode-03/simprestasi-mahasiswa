{{-- resources/views/admin/partials/tab-dashboard.blade.php --}}
<section id="dashboardTab" class="space-y-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 card-shadow flex items-center space-x-4">
            <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-xl"><i class="fas fa-award"></i></div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Prestasi</p>
                <h3 class="text-2xl font-black text-slate-800" id="dashTotalPrestasi">1,432</h3>
                <p class="text-[10px] text-emerald-500 font-bold"><i class="fas fa-arrow-up"></i> 12% thd bulan lalu</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 card-shadow flex items-center space-x-4">
            <div class="w-14 h-14 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center text-xl"><i class="fas fa-clock"></i></div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Menunggu Verif</p>
                <h3 class="text-2xl font-black text-slate-800">12</h3>
                <p class="text-[10px] text-rose-500 font-bold">Butuh tindakan segera</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 card-shadow flex items-center space-x-4">
            <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center text-xl"><i class="fas fa-users"></i></div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Mahasiswa Aktif</p>
                <h3 class="text-2xl font-black text-slate-800">8,540</h3>
                <p class="text-[10px] text-slate-400 font-bold">Tersebar di 21 Prodi</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-[2rem] border border-slate-100 card-shadow flex items-center space-x-4">
            <div class="w-14 h-14 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center text-xl"><i class="fas fa-globe"></i></div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Internasional</p>
                <h3 class="text-2xl font-black text-slate-800">24</h3>
                <p class="text-[10px] text-emerald-500 font-bold">Tahun Akademik 2024</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 bg-white p-8 rounded-[2.5rem] card-shadow border border-slate-100">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h4 class="text-lg font-black text-slate-800">Tren Pertumbuhan Prestasi</h4>
                    <p class="text-xs text-slate-400 font-medium">Statistik akumulasi prestasi per bulan tahun 2024</p>
                </div>
                <select class="bg-slate-50 border-none text-xs font-bold text-slate-600 rounded-lg px-3 py-2 outline-none">
                    <option>Tahun 2024</option><option>Tahun 2023</option>
                </select>
            </div>
            <div class="h-72"><canvas id="trendChart"></canvas></div>
        </div>
        <div class="bg-white p-8 rounded-[2.5rem] card-shadow border border-slate-100">
            <h4 class="text-lg font-black text-slate-800 mb-1">Performa Jurusan</h4>
            <p class="text-xs text-slate-400 font-medium mb-8">Distribusi prestasi berdasarkan jurusan</p>
            <div class="h-64 flex items-center justify-center"><canvas id="jurusanChart"></canvas></div>
            <div class="mt-6 space-y-2">
                <div class="flex items-center justify-between text-[10px] font-bold">
                    <span class="flex items-center"><span class="w-2 h-2 rounded-full bg-blue-800 mr-2"></span>Teknologi Informasi</span>
                    <span class="text-slate-600">450 Poin</span>
                </div>
                <div class="flex items-center justify-between text-[10px] font-bold">
                    <span class="flex items-center"><span class="w-2 h-2 rounded-full bg-blue-500 mr-2"></span>Teknik</span>
                    <span class="text-slate-600">320 Poin</span>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white p-8 rounded-[2.5rem] card-shadow border border-slate-100">
            <div class="flex items-center justify-between mb-6">
                <h4 class="text-lg font-black text-slate-800">Log Aktivitas Sistem</h4>
                <button class="text-primary text-xs font-bold hover:underline">Lihat Semua</button>
            </div>
            <div class="space-y-6">
                <div class="flex items-start space-x-4">
                    <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0 mt-1"><i class="fas fa-check text-xs"></i></div>
                    <div><p class="text-sm font-bold text-slate-700">Prestasi "Web Design" Disetujui</p><p class="text-[10px] text-slate-400 font-medium">Oleh Admin 1 • 2 Menit yang lalu</p></div>
                </div>
                <div class="flex items-start space-x-4">
                    <div class="w-10 h-10 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center shrink-0 mt-1"><i class="fas fa-file-import text-xs"></i></div>
                    <div><p class="text-sm font-bold text-slate-700">Pengajuan Baru: Budi Santoso</p><p class="text-[10px] text-slate-400 font-medium">Lomba Inovasi TIK • 15 Menit yang lalu</p></div>
                </div>
                <div class="flex items-start space-x-4">
                    <div class="w-10 h-10 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center shrink-0 mt-1"><i class="fas fa-times text-xs"></i></div>
                    <div><p class="text-sm font-bold text-slate-700">Prestasi "Karate" Ditolak</p><p class="text-[10px] text-slate-400 font-medium">Sertifikat tidak valid • 1 Jam yang lalu</p></div>
                </div>
            </div>
        </div>
        <div class="bg-white p-8 rounded-[2.5rem] card-shadow border border-slate-100">
            <div class="flex items-center justify-between mb-6">
                <h4 class="text-lg font-black text-slate-800">Top Mahasiswa Berprestasi</h4>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 bg-primary text-white text-[10px] font-bold rounded-lg">Nasional</button>
                    <button class="px-3 py-1 bg-slate-50 text-slate-400 text-[10px] font-bold rounded-lg">Global</button>
                </div>
            </div>
            <div class="overflow-hidden">
                <table class="w-full">
                    <tbody class="divide-y divide-slate-50">
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-3"><div class="flex items-center space-x-3"><div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center font-black text-primary text-xs">1</div><div><p class="text-xs font-bold text-slate-800">Rizky Ramadhan</p><p class="text-[9px] text-slate-400">Teknik Informatika</p></div></div></td>
                            <td class="text-right py-3"><span class="text-xs font-black text-primary">450 Poin</span></td>
                        </tr>
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-3"><div class="flex items-center space-x-3"><div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center font-black text-slate-500 text-xs">2</div><div><p class="text-xs font-bold text-slate-800">Siti Aminah</p><p class="text-[9px] text-slate-400">Manajemen Informatika</p></div></div></td>
                            <td class="text-right py-3"><span class="text-xs font-black text-primary">390 Poin</span></td>
                        </tr>
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-3"><div class="flex items-center space-x-3"><div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center font-black text-slate-500 text-xs">3</div><div><p class="text-xs font-bold text-slate-800">Kevin Pratama</p><p class="text-[9px] text-slate-400">Teknik Komputer</p></div></div></td>
                            <td class="text-right py-3"><span class="text-xs font-black text-primary">310 Poin</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>