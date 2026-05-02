{{-- resources/views/admin/partials/tab-data-prestasi.blade.php --}}
<section id="dataprestasiTab" class="hidden space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Data Prestasi Mahasiswa</h2>
            <p class="text-slate-500 text-sm">Manajemen dan verifikasi data capaian mahasiswa.</p>
        </div>
        <div class="flex items-center gap-2">
            <button onclick="renderPrestasiTable()" class="px-4 py-2 bg-white border border-slate-200 text-slate-600 rounded-xl text-xs font-bold hover:bg-slate-50 transition-all flex items-center gap-2">
                <i class="fas fa-sync-alt"></i> Refresh
            </button>
            <button onclick="openPrestasiModal()" class="px-4 py-2 bg-cyan-500 text-white rounded-xl text-xs font-bold hover:bg-cyan-600 transition-all flex items-center gap-2 shadow-lg shadow-cyan-100">
                <i class="fas fa-plus"></i> Tambah Data Prestasi
            </button>
            <button onclick="showToast('File Excel sedang diekspor...','info')" class="px-4 py-2 bg-emerald-600 text-white rounded-xl text-xs font-bold hover:bg-emerald-700 transition-all flex items-center gap-2 shadow-lg shadow-emerald-100">
                <i class="fas fa-file-excel"></i> Export Excel
            </button>
        </div>
    </div>

    {{-- Filter Bar --}}
    <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm flex flex-col md:flex-row gap-4">
        <div class="relative flex-1">
            <span class="absolute inset-y-0 left-4 flex items-center text-slate-400"><i class="fas fa-search text-xs"></i></span>
            <input type="text" id="searchFilter" placeholder="Cari berdasarkan Nama atau NIM..."
                class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all">
        </div>
        <div class="flex flex-wrap items-center gap-3">
            <select id="jurusanFilterPrestasi" class="px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-600 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all min-w-[140px]">
                <option value="">Jurusan</option>
                <option value="Teknologi Informasi">Teknologi Informasi</option>
                <option value="Teknik">Teknik</option>
                <option value="Pertanian">Pertanian</option>
                <option value="Kesehatan">Kesehatan</option>
            </select>
            <select id="kategoriFilter" class="px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-600 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all min-w-[140px]">
                <option value="">Kategori</option>
                <option value="Akademik">Akademik</option>
                <option value="Olahraga">Olahraga</option>
                <option value="Sains">Sains</option>
                <option value="Karya Ilmiah">Karya Ilmiah</option>
                <option value="Wirausaha">Wirausaha</option>
                <option value="Seni">Seni</option>
            </select>
            <select id="tingkatFilter" class="px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-600 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all min-w-[140px]">
                <option value="">Tingkat</option>
                <option value="Internasional">Internasional</option>
                <option value="Nasional">Nasional</option>
                <option value="Provinsi">Provinsi</option>
                <option value="Kabupaten">Kabupaten</option>
            </select>
            <select id="tahunFilter" class="px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-600 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all">
                <option value="">Tahun</option>
                <option value="2026">2026</option>
                <option value="2025">2025</option>
                <option value="2024">2024</option>
                <option value="2023">2023</option>
            </select>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse" id="tablePrestasi">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="px-6 py-5">NIM</th>
                        <th class="px-6 py-5">Nama Mahasiswa</th>
                        <th class="px-6 py-5">Prestasi</th>
                        <th class="px-6 py-5">Lomba</th>
                        <th class="px-6 py-5 text-center">Kategori</th>
                        <th class="px-6 py-5 text-center">Tingkat</th>
                        <th class="px-6 py-5 text-center">Tahun</th>
                        <th class="px-6 py-5 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100" id="prestasiTableBody">
                    {{-- Rendered by JavaScript --}}
                </tbody>
            </table>
            <div id="noData" class="hidden p-16 text-center">
                <i class="fas fa-folder-open text-4xl text-slate-200 mb-3 block"></i>
                <p class="text-slate-400 text-sm font-medium italic">Tidak ada data yang sesuai dengan kriteria filter.</p>
                <button onclick="resetFilters()" class="mt-4 text-xs font-bold text-indigo-600 hover:underline">Reset Semua Filter</button>
            </div>
        </div>
        <div class="px-6 py-4 bg-slate-50 border-t border-slate-200 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Menampilkan <span id="visibleCount" class="text-slate-700">0</span> data</span>
            <div class="flex items-center gap-1">
                <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-400"><i class="fas fa-chevron-left text-[10px]"></i></button>
                <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-indigo-900 text-white shadow-sm font-bold text-[10px]">1</button>
                <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-600 font-bold text-[10px]">2</button>
                <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-600 font-bold text-[10px]">3</button>
                <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-600"><i class="fas fa-chevron-right text-[10px]"></i></button>
            </div>
        </div>
    </div>
</section>