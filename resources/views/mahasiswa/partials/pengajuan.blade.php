<section id="pengajuan-section" class="hidden flex-1 flex flex-col min-h-0 animate-fadeIn">

    <!-- TAB NAV -->
    <div class="flex gap-2 mb-8 bg-slate-100 p-1.5 rounded-2xl self-start shrink-0 border border-slate-200"
        role="tablist">
        <button onclick="switchFormTab('form')" id="tab-form-btn" role="tab" aria-selected="true"
            aria-controls="subtab-form"
            class="tab-btn px-8 py-3 rounded-xl font-bold text-sm transition-all bg-blue-600 text-white flex items-center">
            <i class="fas fa-plus-circle mr-2.5"></i>Tambah Pengajuan
        </button>
        <button onclick="switchFormTab('history')" id="tab-history-btn" role="tab" aria-selected="false"
            aria-controls="subtab-history"
            class="tab-btn px-8 py-3 rounded-xl font-bold text-sm transition-all text-slate-500 hover:text-slate-700 flex items-center">
            <i class="fas fa-history mr-2.5 opacity-70"></i>Riwayat Pengajuan
        </button>
    </div>

    <!-- FORM TAB -->
    <div id="subtab-form" role="tabpanel" class="flex-1 overflow-y-auto pr-4 pb-12 custom-scroll">

        {{-- Success / Error Alert --}}
        @if (session('success'))
            <div
                class="mb-6 flex items-center gap-3 px-6 py-4 bg-green-50 border border-green-200 rounded-2xl text-green-700 text-sm font-semibold">
                <i class="fas fa-check-circle text-green-500 text-base"></i>
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div
                class="mb-6 flex items-start gap-3 px-6 py-4 bg-red-50 border border-red-200 rounded-2xl text-red-700 text-sm font-semibold">
                <i class="fas fa-exclamation-circle text-red-500 text-base mt-0.5"></i>
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="pengajuan-form" method="POST" action="{{ route('mahasiswa.prestasi.store') }}"
            enctype="multipart/form-data"
            class="relative overflow-hidden bg-white rounded-[2rem] border border-slate-200" novalidate>
            @csrf

            <div
                class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-blue-400 via-blue-600 to-blue-800 z-10">
            </div>

            <div class="p-8 md:p-12 pt-10 md:pt-14 space-y-6">

                {{-- ─── BAGIAN 1: Identitas Kompetisi ─── --}}
                <div class="flex items-center gap-3 pt-2">
                    <div class="h-px flex-1 bg-slate-100"></div>
                    <span
                        class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">
                        <i class="fas fa-trophy text-[9px]"></i> Identitas Kompetisi
                    </span>
                    <div class="h-px flex-1 bg-slate-100"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="group space-y-2">
                        <label for="nama_kompetisi"
                            class="flex items-center text-[11px] font-black text-blue-900/40 uppercase tracking-widest ml-1 group-focus-within:text-blue-600 transition-colors">
                            <i class="fas fa-trophy mr-2 text-[9px]"></i> Nama Kompetisi
                        </label>
                        <input type="text" id="nama_kompetisi" name="nama_kompetisi" required
                            value="{{ old('nama_kompetisi') }}" placeholder="Contoh: PKM-KC Nasional 2026"
                            class="w-full px-6 py-4 bg-slate-50 border @error('nama_kompetisi') border-red-400 bg-red-50 @else border-slate-200 @enderror rounded-2xl text-sm focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white outline-none font-medium transition-all"
                            aria-describedby="err-nama">
                        @error('nama_kompetisi')
                            <p class="field-error text-red-500 text-xs mt-1 ml-1" id="err-nama">{{ $message }}</p>
                        @else
                            <p class="field-error hidden" id="err-nama">Nama kompetisi wajib diisi.</p>
                        @enderror
                    </div>
                    <div class="group space-y-2">
                        <label for="penyelenggara"
                            class="flex items-center text-[11px] font-black text-blue-900/40 uppercase tracking-widest ml-1 group-focus-within:text-blue-600 transition-colors">
                            <i class="fas fa-building mr-2 text-[9px]"></i> Penyelenggara
                        </label>
                        <input type="text" id="penyelenggara" name="penyelenggara" required
                            value="{{ old('penyelenggara') }}" placeholder="Contoh: KEMENDIKBUDRISTEK"
                            class="w-full px-6 py-4 bg-slate-50 border @error('penyelenggara') border-red-400 bg-red-50 @else border-slate-200 @enderror rounded-2xl text-sm focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white outline-none font-medium transition-all"
                            aria-describedby="err-penyelenggara">
                        @error('penyelenggara')
                            <p class="field-error text-red-500 text-xs mt-1 ml-1" id="err-penyelenggara">{{ $message }}
                            </p>
                        @else
                            <p class="field-error hidden" id="err-penyelenggara">Penyelenggara wajib diisi.</p>
                        @enderror
                    </div>
                </div>

                {{-- ─── BAGIAN 2: Klasifikasi & Tanggal ─── --}}
                <div class="flex items-center gap-3">
                    <div class="h-px flex-1 bg-slate-100"></div>
                    <span
                        class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">
                        <i class="fas fa-tags text-[9px]"></i> Klasifikasi &amp; Tanggal
                    </span>
                    <div class="h-px flex-1 bg-slate-100"></div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    {{-- Kategori --}}
                    <div class="space-y-2">
                        <label for="kategori_id"
                            class="text-[11px] font-black text-blue-900/40 uppercase tracking-widest ml-1">Kategori</label>
                        <select id="kategori_id" name="kategori_id" required
                            class="w-full px-5 py-4 bg-slate-50 border @error('kategori_id') border-red-400 bg-red-50 @else border-slate-200 @enderror rounded-2xl text-sm font-bold focus:ring-4 focus:ring-blue-500/10 transition-all cursor-pointer outline-none">
                            <option value="" disabled {{ old('kategori_id') ? '' : 'selected' }}>Pilih...</option>
                            @foreach ($kategori as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('kategori_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tingkat --}}
                    <div class="space-y-2">
                        <label for="tingkat_id"
                            class="text-[11px] font-black text-blue-900/40 uppercase tracking-widest ml-1">Tingkat</label>
                        <select id="tingkat_id" name="tingkat_id" required
                            class="w-full px-5 py-4 bg-slate-50 border @error('tingkat_id') border-red-400 bg-red-50 @else border-slate-200 @enderror rounded-2xl text-sm font-bold focus:ring-4 focus:ring-blue-500/10 transition-all cursor-pointer outline-none">
                            <option value="" disabled {{ old('tingkat_id') ? '' : 'selected' }}>Pilih...</option>
                            @foreach ($tingkat as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('tingkat_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_tingkat }}
                                </option>
                            @endforeach
                        </select>
                        @error('tingkat_id')
                            <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Capaian --}}
                    <div class="space-y-2">
                        <label for="capaian_id"
                            class="text-[11px] font-black text-blue-900/40 uppercase tracking-widest ml-1">Capaian</label>
                        <select id="capaian_id" name="capaian_id" required
                            class="w-full px-5 py-4 bg-slate-50 border @error('capaian_id') border-red-400 bg-red-50 @else border-slate-200 @enderror rounded-2xl text-sm font-bold focus:ring-4 focus:ring-blue-500/10 transition-all cursor-pointer outline-none">
                            <option value="" disabled {{ old('capaian_id') ? '' : 'selected' }}>Pilih...</option>
                            @foreach ($capaian as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('capaian_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_capaian }}
                                </option>
                            @endforeach
                        </select>
                        @error('capaian_id')
                            <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tanggal Pelaksanaan --}}
                    <div class="space-y-2">
                        <label for="tanggal"
                            class="text-[11px] font-black text-blue-900/40 uppercase tracking-widest ml-1">
                            Tanggal Pelaksanaan
                        </label>
                        <input type="date" id="tanggal" name="tanggal" required value="{{ old('tanggal') }}"
                            class="w-full px-5 py-4 bg-slate-50 border @error('tanggal') border-red-400 bg-red-50 @else border-slate-200 @enderror rounded-2xl text-sm font-bold focus:ring-4 focus:ring-blue-500/10 outline-none transition-all">
                        @error('tanggal')
                            <p class="text-red-500 text-xs mt-1 ml-1" id="err-tanggal">{{ $message }}</p>
                        @else
                            <p class="field-error hidden" id="err-tanggal">Tanggal wajib diisi.</p>
                        @enderror
                    </div>
                </div>

                {{-- ─── BAGIAN 3: Informasi Tambahan ─── --}}
                <div class="flex items-center gap-3">
                    <div class="h-px flex-1 bg-slate-100"></div>
                    <span
                        class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">
                        <i class="fas fa-info-circle text-[9px]"></i> Informasi Tambahan
                    </span>
                    <div class="h-px flex-1 bg-slate-100"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="group space-y-2">
                        <label for="dosen"
                            class="flex items-center text-[11px] font-black text-blue-900/40 uppercase tracking-widest ml-1 group-focus-within:text-blue-600 transition-colors">
                            <i class="fas fa-user-tie mr-2 text-[9px]"></i> Dosen Pembimbing
                        </label>
                        <input type="text" id="dosen" name="dosen" value="{{ old('dosen') }}"
                            placeholder="Nama dosen lengkap..."
                            class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium focus:ring-4 focus:ring-blue-500/10 outline-none transition-all">
                    </div>
                    <div class="group space-y-2">
                        <label for="lokasi"
                            class="flex items-center text-[11px] font-black text-blue-900/40 uppercase tracking-widest ml-1 group-focus-within:text-blue-600 transition-colors">
                            <i class="fas fa-map-marker-alt mr-2 text-[9px]"></i> Lokasi (Kota)
                        </label>
                        <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi') }}"
                            placeholder="Contoh: Surabaya, Indonesia"
                            class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium focus:ring-4 focus:ring-blue-500/10 outline-none transition-all">
                    </div>
                    <div class="group space-y-2">
                        <label for="link_pendukung"
                            class="flex items-center text-[11px] font-black text-blue-900/40 uppercase tracking-widest ml-1 group-focus-within:text-blue-600 transition-colors">
                            <i class="fas fa-link mr-2 text-[9px]"></i> Link Pendukung
                        </label>
                        <input type="url" id="link_pendukung" name="link_pendukung"
                            value="{{ old('link_pendukung') }}" placeholder="https://..."
                            class="w-full px-6 py-4 bg-slate-50 border @error('link_pendukung') border-red-400 bg-red-50 @else border-slate-200 @enderror rounded-2xl text-sm font-medium focus:ring-4 focus:ring-blue-500/10 outline-none transition-all">
                        @error('link_pendukung')
                            <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- ─── BAGIAN 4: Deskripsi Prestasi ─── --}}
                <div class="flex items-center gap-3">
                    <div class="h-px flex-1 bg-slate-100"></div>
                    <span
                        class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">
                        <i class="fas fa-align-left text-[9px]"></i> Deskripsi Prestasi
                    </span>
                    <div class="h-px flex-1 bg-slate-100"></div>
                </div>

                <div class="space-y-2">
                    <label for="deskripsi"
                        class="flex items-center text-[11px] font-black text-blue-900/40 uppercase tracking-widest ml-1 group-focus-within:text-blue-600 transition-colors">
                        <i class="fas fa-align-left mr-2 text-[9px]"></i>
                        Deskripsi
                        <span class="ml-2 normal-case font-semibold text-slate-300 tracking-normal">(opsional)</span>
                    </label>
                    <textarea id="deskripsi" name="deskripsi" maxlength="1000" rows="4"
                        placeholder="Ceritakan secara singkat tentang kompetisi, proses, dan pencapaian yang diraih..."
                        class="w-full px-6 py-4 bg-slate-50 border @error('deskripsi') border-red-400 bg-red-50 @else border-slate-200 @enderror rounded-2xl text-sm font-medium focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white outline-none transition-all resize-y leading-relaxed"
                        oninput="updateDeskripsCounter(this)" aria-describedby="deskripsi-counter">{{ old('deskripsi') }}</textarea>
                    <div class="flex justify-between items-center mt-1 px-1">
                        @error('deskripsi')
                            <p class="text-red-500 text-xs">{{ $message }}</p>
                        @enderror
                        <span id="deskripsi-counter"
                            class="text-[11px] font-semibold text-slate-400 ml-auto tabular-nums">
                            {{ strlen(old('deskripsi', '')) }} / 1000
                        </span>
                    </div>
                </div>

                {{-- ─── BAGIAN 5: Unggah Berkas ─── --}}
                <div class="flex items-center gap-3">
                    <div class="h-px flex-1 bg-slate-100"></div>
                    <span
                        class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap">
                        <i class="fas fa-upload text-[9px]"></i> Unggah Berkas
                    </span>
                    <div class="h-px flex-1 bg-slate-100"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- Upload Sertifikat --}}
                    <div id="zone-cert"
                        class="upload-zone relative p-10 bg-slate-50 border-2 border-dashed border-slate-200 rounded-[2rem] text-center hover:border-blue-400 hover:bg-blue-50/50 transition-all duration-500 group cursor-pointer">
                        <input type="file" name="file_sertifikat[]" id="file-cert"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept=".pdf"
                            multiple onchange="updateFileName(this, 'label-cert')" aria-label="Pilih file sertifikat">
                        <div id="label-cert" class="relative z-0 pointer-events-none">
                            <div
                                class="w-14 h-14 bg-white border border-slate-200 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-500">
                                <i class="fas fa-file-pdf text-2xl text-blue-500"></i>
                            </div>
                            <p class="text-[10px] font-black uppercase text-slate-500 tracking-[0.2em] mb-1">Upload
                                Sertifikat</p>
                            <p class="text-[10px] text-slate-400 font-medium mb-4 italic">Format PDF · Bisa lebih dari
                                satu</p>
                            <span
                                class="inline-block px-8 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-bold text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">
                                Pilih File
                            </span>
                        </div>
                    </div>

                    {{-- Upload Foto --}}
                    <div id="zone-photo"
                        class="upload-zone relative p-10 bg-slate-50 border-2 border-dashed border-slate-200 rounded-[2rem] text-center hover:border-indigo-400 hover:bg-indigo-50/50 transition-all duration-500 group cursor-pointer">
                        <input type="file" name="file_foto[]" id="file-photo"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="image/*"
                            multiple onchange="updateFileName(this, 'label-photo')"
                            aria-label="Pilih foto dokumentasi">
                        <div id="label-photo" class="relative z-0 pointer-events-none">
                            <div
                                class="w-14 h-14 bg-white border border-slate-200 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-500">
                                <i class="fas fa-image text-2xl text-indigo-500"></i>
                            </div>
                            <p class="text-[10px] font-black uppercase text-slate-500 tracking-[0.2em] mb-1">Upload
                                Dokumentasi</p>
                            <p class="text-[10px] text-slate-400 font-medium mb-4 italic">Format Gambar · Bisa lebih
                                dari satu</p>
                            <span
                                class="inline-block px-8 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-bold text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300">
                                Pilih Foto
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Footer Form -->
                <div class="flex flex-col md:flex-row gap-4 pt-8 border-t border-slate-100">
                    <button type="submit" id="submit-btn"
                        class="flex-[2] py-5 bg-gradient-to-r bg-blue-700 text-white rounded-2xl font-bold hover:bg-blue-800 transition-all flex items-center justify-center gap-3">
                        <div class="btn-spinner" id="submit-spinner" aria-hidden="true"></div>
                        <i class="fas fa-paper-plane" id="submit-icon"></i>
                        <span id="submit-label">Kirim Pengajuan Prestasi</span>
                    </button>
                    <button type="button" onclick="confirmReset()"
                        class="flex-1 py-5 bg-slate-50 border border-slate-200 text-slate-500 rounded-2xl font-bold text-sm hover:bg-red-50 hover:text-red-500 hover:border-red-200 transition-all duration-300">
                        Reset Form
                    </button>
                </div>

        </form>
    </div>

    <!-- HISTORY TAB -->
    <div id="subtab-history" role="tabpanel" class="hidden flex-1 overflow-y-auto custom-scroll pb-10">
        <div class="bg-white rounded-[2.5rem] border border-slate-200 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left" aria-label="Riwayat pengajuan prestasi">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th scope="col"
                                class="px-10 py-6 text-[10px] font-black text-blue-900/40 uppercase tracking-widest">
                                Informasi Kompetisi
                            </th>
                            <th scope="col"
                                class="px-6 py-6 text-[10px] font-black text-blue-900/40 uppercase tracking-widest text-center">
                                Klasifikasi
                            </th>
                            <th scope="col"
                                class="px-6 py-6 text-[10px] font-black text-blue-900/40 uppercase tracking-widest text-center">
                                Status
                            </th>
                            <th scope="col"
                                class="px-10 py-6 text-[10px] font-black text-blue-900/40 uppercase tracking-widest text-right">
                                Opsi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($prestasi as $item)
                            <tr class="hover:bg-blue-50/50 transition">
                                <td class="px-10 py-6">
                                    <div class="font-bold text-slate-700">{{ $item->nama_kompetisi }}</div>
                                    <div class="text-[11px] text-slate-400 font-medium">{{ $item->penyelenggara }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="text-slate-600 text-sm font-semibold">
                                        {{ $item->kategori->nama_kategori ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="px-3 py-1 rounded-full text-[10px] font-black uppercase 
                                    {{ $item->status == 'pending' ? 'bg-amber-100 text-amber-600' : '' }}
                                    {{ $item->status == 'disetujui' ? 'bg-green-100 text-green-600' : '' }}
                                    {{ $item->status == 'ditolak' ? 'bg-red-100 text-red-600' : '' }}">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td class="px-10 py-6 text-right">
                                    <a href="{{ route('mahasiswa.prestasi.show', $item->id) }}"
                                        class="inline-flex items-center justify-center px-4 py-2 bg-blue-50 text-blue-600 rounded-xl font-black text-[10px] uppercase tracking-wider hover:bg-blue-600 hover:text-white transition-all">
                                        DETAIL
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-20 text-slate-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <i class="fas fa-history text-4xl mb-4 opacity-10"></i>
                                        <p class="font-bold text-sm uppercase tracking-widest opacity-40">Belum ada
                                            riwayat prestasi</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination - Hanya muncul sekali di bawah --}}
            @if ($prestasi->hasPages())
                <div class="px-10 py-6 border-t border-slate-100 bg-slate-50/50">
                    {{ $prestasi->links() }}
                </div>
            @endif
        </div>
    </div>

</section>
