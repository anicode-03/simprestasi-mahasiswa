{{-- resources/views/mahasiswa/partials/section-pengajuan.blade.php --}}
<section id="pengajuan-section" class="hidden flex-1 flex flex-col min-h-0">
    <div class="flex gap-4 mb-6 bg-slate-100 p-1 rounded-2xl self-start shrink-0" role="tablist" aria-label="Tab pengajuan">
        <button onclick="switchFormTab('form')" id="tab-form-btn" role="tab" aria-selected="true" aria-controls="subtab-form"
            class="px-6 py-2.5 rounded-xl font-bold text-sm transition-all bg-white text-blue-700 shadow-sm">
            <i class="fas fa-plus-circle mr-2" aria-hidden="true"></i>Tambah Pengajuan
        </button>
        <button onclick="switchFormTab('history')" id="tab-history-btn" role="tab" aria-selected="false" aria-controls="subtab-history"
            class="px-6 py-2.5 rounded-xl font-bold text-sm transition-all text-slate-500 hover:bg-white/50">
            <i class="fas fa-history mr-2" aria-hidden="true"></i>Riwayat Pengajuan
        </button>
    </div>

    {{-- FORM TAB --}}
    <div id="subtab-form" role="tabpanel" class="flex-1 overflow-y-auto pr-4 pb-10 custom-scroll">
        <form id="pengajuan-form" action="{{ route('mahasiswa.pengajuan.store') }}" method="POST" enctype="multipart/form-data"
              class="space-y-8 bg-white p-8 md:p-10 rounded-[40px] border border-slate-200 shadow-sm"
              novalidate>
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label for="nama_kompetisi" class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Nama Kompetisi</label>
                    <input type="text" id="nama_kompetisi" name="nama_kompetisi" required
                        placeholder="Contoh: PKM-KC Nasional 2026"
                        value="{{ old('nama_kompetisi') }}"
                        class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:ring-4 focus:ring-blue-500/5 outline-none font-medium transition-colors"
                        aria-describedby="err-nama">
                    <p class="field-error" id="err-nama">Nama kompetisi wajib diisi.</p>
                </div>
                <div class="space-y-2">
                    <label for="penyelenggara" class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Penyelenggara</label>
                    <input type="text" id="penyelenggara" name="penyelenggara" required
                        placeholder="Contoh: KEMENDIKBUDRISTEK"
                        value="{{ old('penyelenggara') }}"
                        class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:ring-4 focus:ring-blue-500/5 outline-none font-medium transition-colors"
                        aria-describedby="err-penyelenggara">
                    <p class="field-error" id="err-penyelenggara">Penyelenggara wajib diisi.</p>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="space-y-2">
                    <label for="kategori" class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Kategori</label>
                    <select id="kategori" name="kategori" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold transition-colors">
                        <option>Akademik</option>
                        <option>Seni</option>
                        <option>Olahraga</option>
                        <option>Teknologi</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label for="tingkat" class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Tingkat</label>
                    <select id="tingkat" name="tingkat" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold transition-colors">
                        <option>Internasional</option>
                        <option>Nasional</option>
                        <option>Provinsi</option>
                        <option>Kabupaten/Kota</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label for="capaian" class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Capaian</label>
                    <select id="capaian" name="capaian" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold transition-colors">
                        <option>Juara 1</option>
                        <option>Juara 2</option>
                        <option>Juara 3</option>
                        <option>Harapan</option>
                        <option>Finalis</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label for="tanggal" class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Tanggal Pelaksanaan</label>
                    <input type="date" id="tanggal" name="tanggal" required
                        value="{{ old('tanggal') }}"
                        class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold transition-colors"
                        aria-describedby="err-tanggal">
                    <p class="field-error" id="err-tanggal">Tanggal wajib diisi.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label for="dosen" class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Dosen Pembimbing</label>
                    <input type="text" id="dosen" name="dosen" placeholder="Masukkan nama dosen lengkap..."
                        value="{{ old('dosen') }}"
                        class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium transition-colors">
                </div>
                <div class="space-y-2">
                    <label for="lokasi" class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Lokasi (Kota)</label>
                    <input type="text" id="lokasi" name="lokasi" placeholder="Misal: Surabaya, Indonesia"
                        value="{{ old('lokasi') }}"
                        class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium transition-colors">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Upload Sertifikat --}}
                <div id="zone-cert"
                    class="upload-zone relative p-8 bg-slate-50 border-2 border-dashed border-slate-200 rounded-[30px] text-center hover:border-blue-400 hover:bg-blue-50/30 transition-all group"
                    role="button" tabindex="0" aria-label="Upload file sertifikat PDF">
                    <input type="file" name="file_sertifikat[]" id="file-cert"
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                        accept=".pdf" multiple
                        onchange="updateFileName(this, 'label-cert')"
                        aria-label="Pilih file sertifikat">
                    <div id="label-cert">
                        <i class="fas fa-file-pdf text-4xl text-slate-300 mb-3 group-hover:text-blue-500" aria-hidden="true"></i>
                        <p class="text-[10px] font-black uppercase text-slate-500 tracking-widest">Sertifikat (PDF - Bisa pilih banyak)</p>
                        <span class="mt-4 inline-block px-6 py-2 bg-white border border-slate-200 rounded-xl text-xs font-bold shadow-sm">Pilih File</span>
                    </div>
                </div>

                {{-- Upload Foto --}}
                <div id="zone-photo"
                    class="upload-zone relative p-8 bg-slate-50 border-2 border-dashed border-slate-200 rounded-[30px] text-center hover:border-blue-400 hover:bg-blue-50/30 transition-all group"
                    role="button" tabindex="0" aria-label="Upload foto dokumentasi">
                    <input type="file" name="file_foto[]" id="file-photo"
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                        accept="image/*" multiple
                        onchange="updateFileName(this, 'label-photo')"
                        aria-label="Pilih foto dokumentasi">
                    <div id="label-photo">
                        <i class="fas fa-image text-4xl text-slate-300 mb-3 group-hover:text-blue-500" aria-hidden="true"></i>
                        <p class="text-[10px] font-black uppercase text-slate-500 tracking-widest">Foto Dokumentasi (Bisa pilih banyak)</p>
                        <span class="mt-4 inline-block px-6 py-2 bg-white border border-slate-200 rounded-xl text-xs font-bold shadow-sm">Pilih Foto</span>
                    </div>
                </div>
            </div>

            <div class="flex flex-col md:flex-row gap-4 pt-6 border-t border-slate-100">
                <button type="submit" id="submit-btn"
                    class="flex-1 py-4 bg-blue-700 text-white rounded-2xl font-bold shadow-lg shadow-blue-200 hover:bg-blue-800 hover:-translate-y-1 transition-all flex items-center justify-center gap-2 disabled:opacity-60 disabled:cursor-not-allowed disabled:hover:translate-y-0">
                    <div class="btn-spinner" id="submit-spinner" aria-hidden="true"></div>
                    <i class="fas fa-paper-plane" id="submit-icon" aria-hidden="true"></i>
                    <span id="submit-label">Kirim Pengajuan Prestasi</span>
                </button>
                <button type="button" onclick="confirmReset()"
                    class="px-10 py-4 bg-slate-100 text-slate-500 rounded-2xl font-bold hover:bg-slate-200 transition-all">
                    Reset
                </button>
            </div>
        </form>
    </div>

    {{-- HISTORY TAB --}}
    <div id="subtab-history" role="tabpanel" class="hidden flex-1 overflow-y-auto custom-scroll">
        <div class="bg-white rounded-[40px] border border-slate-200 overflow-hidden shadow-sm">
            <table class="w-full text-left" aria-label="Riwayat pengajuan prestasi">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th scope="col" class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Kompetisi</th>
                        <th scope="col" class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Tingkat</th>
                        <th scope="col" class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                        <th scope="col" class="px-10 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($daftarPrestasi ?? [] as $p)
                    <tr class="hover:bg-slate-50 transition-colors group">
                        <td class="px-8 py-6">
                            <div class="font-bold text-slate-700">{{ $p->nama ?? $p['nama'] }}</div>
                            <div class="text-[10px] text-slate-400">Diajukan pada: {{ $p->tanggal ?? $p['tanggal'] }}</div>
                        </td>
                        <td class="px-6 py-6 text-center">
                            <span class="text-[13px] font-bold text-slate-600">{{ $p->tingkat ?? $p['tingkat'] }}</span>
                        </td>
                        <td class="px-6 py-6 text-center">
                            @php
                                $status = strtolower($p->status ?? $p['status']);
                                $statusClass = match($status) {
                                    'pending'   => 'bg-amber-50 text-amber-600 border-amber-200/50',
                                    'disetujui' => 'bg-green-50 text-green-600 border-green-200/50',
                                    'ditolak'   => 'bg-red-50 text-red-600 border-red-200/50',
                                    default     => 'bg-slate-50 text-slate-600 border-slate-200/50',
                                };
                            @endphp
                            <span class="inline-block px-4 py-1.5 {{ $statusClass }} text-[10px] font-extrabold uppercase tracking-[0.15em] rounded-full border">
                                {{ $p->status ?? $p['status'] }}
                            </span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <button class="text-blue-600 hover:text-blue-800 text-sm font-bold opacity-0 group-hover:opacity-100 transition-opacity focus:opacity-100"
                                onclick="showToast('info', 'Fitur detail sedang dalam pengembangan.', 'Info')"
                                aria-label="Lihat detail {{ $p->nama ?? $p['nama'] }}">
                                <i class="fas fa-eye mr-1" aria-hidden="true"></i> Detail
                            </button>
                        </td>
                    </tr>
                    @empty
                    {{-- Data dummy --}}
                    @php
                        $dummyPrestasi = [
                            ['nama' => 'Hackathon Polije 2026', 'tanggal' => '12 April 2026', 'tingkat' => 'Nasional', 'status' => 'Pending'],
                            ['nama' => 'Lomba Karya Tulis Ilmiah', 'tanggal' => '10 April 2026', 'tingkat' => 'Provinsi', 'status' => 'Disetujui'],
                            ['nama' => 'Olimpiade Matematika', 'tanggal' => '05 April 2026', 'tingkat' => 'Internasional', 'status' => 'Ditolak'],
                        ];
                    @endphp
                    @foreach($dummyPrestasi as $p)
                    <tr class="hover:bg-slate-50 transition-colors group">
                        <td class="px-8 py-6">
                            <div class="font-bold text-slate-700">{{ $p['nama'] }}</div>
                            <div class="text-[10px] text-slate-400">Diajukan pada: {{ $p['tanggal'] }}</div>
                        </td>
                        <td class="px-6 py-6 text-center">
                            <span class="text-[13px] font-bold text-slate-600">{{ $p['tingkat'] }}</span>
                        </td>
                        <td class="px-6 py-6 text-center">
                            @php
                                $status = strtolower($p['status']);
                                $statusClass = match($status) {
                                    'pending'   => 'bg-amber-50 text-amber-600 border-amber-200/50',
                                    'disetujui' => 'bg-green-50 text-green-600 border-green-200/50',
                                    'ditolak'   => 'bg-red-50 text-red-600 border-red-200/50',
                                    default     => 'bg-slate-50 text-slate-600 border-slate-200/50',
                                };
                            @endphp
                            <span class="inline-block px-4 py-1.5 {{ $statusClass }} text-[10px] font-extrabold uppercase tracking-[0.15em] rounded-full border">
                                {{ $p['status'] }}
                            </span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <button class="text-blue-600 hover:text-blue-800 text-sm font-bold opacity-0 group-hover:opacity-100 transition-opacity focus:opacity-100"
                                onclick="showToast('info', 'Fitur detail sedang dalam pengembangan.', 'Info')"
                                aria-label="Lihat detail {{ $p['nama'] }}">
                                <i class="fas fa-eye mr-1" aria-hidden="true"></i> Detail
                            </button>
                        </td>
                    </tr>
                    @endforeach
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>