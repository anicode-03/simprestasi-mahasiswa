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
        <form id="pengajuan-form"
            class="space-y-8 bg-white p-8 md:p-12 rounded-[2.5rem] border border-slate-200 relative overflow-hidden"
            novalidate>
            <!-- Accent top bar -->
            <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-blue-400 to-blue-700"></div>

            <!-- Bagian 1 -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="group space-y-2">
                    <label for="nama_kompetisi"
                        class="flex items-center text-[11px] font-black text-blue-900/40 uppercase tracking-widest ml-1 group-focus-within:text-blue-600 transition-colors">
                        <i class="fas fa-trophy mr-2 text-[10px]"></i> Nama Kompetisi
                    </label>
                    <input type="text" id="nama_kompetisi" name="nama_kompetisi" required
                        placeholder="Contoh: PKM-KC Nasional 2026"
                        class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white outline-none font-medium transition-all"
                        aria-describedby="err-nama">
                    <p class="field-error" id="err-nama">Nama kompetisi wajib diisi.</p>
                </div>
                <div class="group space-y-2">
                    <label for="penyelenggara"
                        class="flex items-center text-[11px] font-black text-blue-900/40 uppercase tracking-widest ml-1 group-focus-within:text-blue-600 transition-colors">
                        <i class="fas fa-building mr-2 text-[10px]"></i> Penyelenggara
                    </label>
                    <input type="text" id="penyelenggara" name="penyelenggara" required
                        placeholder="Contoh: KEMENDIKBUDRISTEK"
                        class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white outline-none font-medium transition-all"
                        aria-describedby="err-penyelenggara">
                    <p class="field-error" id="err-penyelenggara">Penyelenggara wajib diisi.</p>
                </div>
            </div>

            <!-- Bagian 2 -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="space-y-2">
                    <label for="kategori"
                        class="text-[11px] font-black text-blue-900/40 uppercase tracking-widest ml-1">Kategori</label>
                    <select id="kategori" name="kategori"
                        class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-blue-500/10 transition-all cursor-pointer outline-none">
                        <option>Akademik</option>
                        <option>Seni</option>
                        <option>Olahraga</option>
                        <option>Teknologi</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label for="tingkat"
                        class="text-[11px] font-black text-blue-900/40 uppercase tracking-widest ml-1">Tingkat</label>
                    <select id="tingkat" name="tingkat"
                        class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-blue-500/10 transition-all cursor-pointer outline-none">
                        <option>Internasional</option>
                        <option>Nasional</option>
                        <option>Provinsi</option>
                        <option>Kabupaten/Kota</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label for="capaian"
                        class="text-[11px] font-black text-blue-900/40 uppercase tracking-widest ml-1">Capaian</label>
                    <select id="capaian" name="capaian"
                        class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-blue-500/10 transition-all cursor-pointer outline-none text-blue-700">
                        <option>Juara 1</option>
                        <option>Juara 2</option>
                        <option>Juara 3</option>
                        <option>Harapan</option>
                        <option>Finalis</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label for="tanggal"
                        class="text-[11px] font-black text-blue-900/40 uppercase tracking-widest ml-1">Tanggal
                        Pelaksanaan</label>
                    <input type="date" id="tanggal" name="tanggal" required
                        class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-blue-500/10 outline-none transition-all"
                        aria-describedby="err-tanggal">
                    <p class="field-error" id="err-tanggal">Tanggal wajib diisi.</p>
                </div>
            </div>

            <!-- Bagian 3 -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="group space-y-2">
                    <label for="dosen"
                        class="text-[11px] font-black text-blue-900/40 uppercase tracking-widest ml-1 group-focus-within:text-blue-600 transition-colors">Dosen
                        Pembimbing</label>
                    <input type="text" id="dosen" name="dosen" placeholder="Nama dosen lengkap..."
                        class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium focus:ring-4 focus:ring-blue-500/10 outline-none transition-all">
                </div>
                <div class="group space-y-2">
                    <label for="lokasi"
                        class="text-[11px] font-black text-blue-900/40 uppercase tracking-widest ml-1 group-focus-within:text-blue-600 transition-colors">Lokasi
                        (Kota)</label>
                    <input type="text" id="lokasi" name="lokasi"
                        placeholder="Misal: Surabaya, Indonesia"
                        class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium focus:ring-4 focus:ring-blue-500/10 outline-none transition-all">
                </div>
                <div class="group space-y-2">
                    <label for="link_pendukung"
                        class="text-[11px] font-black text-blue-900/40 uppercase tracking-widest ml-1 group-focus-within:text-blue-600 transition-colors">Link
                        Pendukung</label>
                    <input type="url" id="link_pendukung" name="link_pendukung"
                        placeholder="https://..."
                        class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium focus:ring-4 focus:ring-blue-500/10 outline-none transition-all">
                </div>
            </div>

            <!-- Bagian 4: Upload -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div id="zone-cert"
                    class="upload-zone relative p-10 bg-slate-50 border-2 border-dashed border-slate-200 rounded-[2.5rem] text-center hover:border-blue-400 hover:bg-blue-50/50 transition-all duration-500 group cursor-pointer">
                    <input type="file" name="file_sertifikat[]" id="file-cert"
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept=".pdf"
                        multiple onchange="updateFileName(this, 'label-cert')"
                        aria-label="Pilih file sertifikat">
                    <div id="label-cert" class="relative z-0">
                        <div
                            class="w-16 h-16 bg-white border border-slate-200 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-500">
                            <i class="fas fa-file-pdf text-3xl text-blue-500"></i>
                        </div>
                        <p class="text-[10px] font-black uppercase text-slate-500 tracking-[0.2em] mb-1">Upload
                            Sertifikat</p>
                        <p class="text-[10px] text-slate-400 font-medium mb-4 italic">(Format PDF - Multiple)
                        </p>
                        <span
                            class="inline-block px-8 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-bold text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300">Pilih
                            File</span>
                    </div>
                </div>
                <div id="zone-photo"
                    class="upload-zone relative p-10 bg-slate-50 border-2 border-dashed border-slate-200 rounded-[2.5rem] text-center hover:border-indigo-400 hover:bg-indigo-50/50 transition-all duration-500 group cursor-pointer">
                    <input type="file" name="file_foto[]" id="file-photo"
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="image/*"
                        multiple onchange="updateFileName(this, 'label-photo')"
                        aria-label="Pilih foto dokumentasi">
                    <div id="label-photo" class="relative z-0">
                        <div
                            class="w-16 h-16 bg-white border border-slate-200 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-500">
                            <i class="fas fa-image text-3xl text-indigo-500"></i>
                        </div>
                        <p class="text-[10px] font-black uppercase text-slate-500 tracking-[0.2em] mb-1">Upload
                            Dokumentasi</p>
                        <p class="text-[10px] text-slate-400 font-medium mb-4 italic">(Format Gambar -
                            Multiple)</p>
                        <span
                            class="inline-block px-8 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-bold text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300">Pilih
                            Foto</span>
                    </div>
                </div>
            </div>

            <!-- Footer Form -->
            <div class="flex flex-col md:flex-row gap-4 pt-8 border-t border-slate-200">
                <button type="submit" id="submit-btn"
                    class="flex-[2] py-5 bg-gradient-to-r from-blue-600 to-blue-800 text-white rounded-2xl font-black text-sm uppercase tracking-widest hover:-translate-y-1 active:translate-y-0 transition-all duration-300 flex items-center justify-center gap-3">
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
        <div class="bg-white rounded-[2.5rem] border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left" aria-label="Riwayat pengajuan prestasi">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th scope="col"
                                class="px-10 py-6 text-[10px] font-black text-blue-900/40 uppercase tracking-widest">
                                Informasi Kompetisi</th>
                            <th scope="col"
                                class="px-6 py-6 text-[10px] font-black text-blue-900/40 uppercase tracking-widest text-center">
                                Tingkat</th>
                            <th scope="col"
                                class="px-6 py-6 text-[10px] font-black text-blue-900/40 uppercase tracking-widest text-center">
                                Status</th>
                            <th scope="col"
                                class="px-10 py-6 text-[10px] font-black text-blue-900/40 uppercase tracking-widest text-right">
                                Opsi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr class="hover:bg-blue-50/30 transition-all group">
                            <td class="px-10 py-7">
                                <div
                                    class="font-bold text-slate-800 text-base mb-1 group-hover:text-blue-700 transition-colors">
                                    Hackathon Polije 2026</div>
                                <div class="flex items-center text-[11px] text-slate-400 font-medium"><i
                                        class="far fa-calendar-alt mr-1.5"></i>Diajukan: 12 April 2026</div>
                            </td>
                            <td class="px-6 py-7 text-center">
                                <span
                                    class="px-4 py-1.5 bg-white border border-slate-200 rounded-lg text-xs font-bold text-slate-600">Nasional</span>
                            </td>
                            <td class="px-6 py-7 text-center">
                                <span
                                    class="inline-flex items-center px-4 py-1.5 bg-amber-50 text-amber-600 border border-amber-200 text-[10px] font-black uppercase tracking-widest rounded-full">
                                    <span
                                        class="w-1.5 h-1.5 rounded-full bg-current mr-2 animate-pulse"></span>Pending
                                </span>
                            </td>
                            <td class="px-10 py-7 text-right">
                                <button
                                    onclick="showToast('info', 'Fitur detail sedang dalam pengembangan.', 'Info')"
                                    class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-blue-50 border border-blue-100 text-blue-600 hover:bg-blue-600 hover:text-white transition-all"
                                    title="Lihat Detail">
                                    <i class="fas fa-chevron-right text-sm"></i>
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-blue-50/30 transition-all group">
                            <td class="px-10 py-7">
                                <div
                                    class="font-bold text-slate-800 text-base mb-1 group-hover:text-blue-700 transition-colors">
                                    Lomba Karya Tulis Ilmiah</div>
                                <div class="flex items-center text-[11px] text-slate-400 font-medium"><i
                                        class="far fa-calendar-alt mr-1.5"></i>Diajukan: 10 April 2026</div>
                            </td>
                            <td class="px-6 py-7 text-center">
                                <span
                                    class="px-4 py-1.5 bg-white border border-slate-200 rounded-lg text-xs font-bold text-slate-600">Provinsi</span>
                            </td>
                            <td class="px-6 py-7 text-center">
                                <span
                                    class="inline-flex items-center px-4 py-1.5 bg-green-50 text-green-600 border border-green-200 text-[10px] font-black uppercase tracking-widest rounded-full">
                                    <span
                                        class="w-1.5 h-1.5 rounded-full bg-current mr-2 animate-pulse"></span>Disetujui
                                </span>
                            </td>
                            <td class="px-10 py-7 text-right">
                                <button
                                    onclick="showToast('info', 'Fitur detail sedang dalam pengembangan.', 'Info')"
                                    class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-blue-50 border border-blue-100 text-blue-600 hover:bg-blue-600 hover:text-white transition-all"
                                    title="Lihat Detail">
                                    <i class="fas fa-chevron-right text-sm"></i>
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-blue-50/30 transition-all group">
                            <td class="px-10 py-7">
                                <div
                                    class="font-bold text-slate-800 text-base mb-1 group-hover:text-blue-700 transition-colors">
                                    Olimpiade Matematika</div>
                                <div class="flex items-center text-[11px] text-slate-400 font-medium"><i
                                        class="far fa-calendar-alt mr-1.5"></i>Diajukan: 05 April 2026</div>
                            </td>
                            <td class="px-6 py-7 text-center">
                                <span
                                    class="px-4 py-1.5 bg-white border border-slate-200 rounded-lg text-xs font-bold text-slate-600">Internasional</span>
                            </td>
                            <td class="px-6 py-7 text-center">
                                <span
                                    class="inline-flex items-center px-4 py-1.5 bg-red-50 text-red-600 border border-red-200 text-[10px] font-black uppercase tracking-widest rounded-full">
                                    <span
                                        class="w-1.5 h-1.5 rounded-full bg-current mr-2 animate-pulse"></span>Ditolak
                                </span>
                            </td>
                            <td class="px-10 py-7 text-right">
                                <button
                                    onclick="showToast('info', 'Fitur detail sedang dalam pengembangan.', 'Info')"
                                    class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-blue-50 border border-blue-100 text-blue-600 hover:bg-blue-600 hover:text-white transition-all"
                                    title="Lihat Detail">
                                    <i class="fas fa-chevron-right text-sm"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>