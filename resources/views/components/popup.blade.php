<div id="popupContainer" class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="closePopup()"></div>

    <div id="popupContent"
        class="relative bg-white w-full max-w-4xl max-h-[90vh] rounded-3xl shadow-2xl overflow-y-auto no-scrollbar opacity-0 scale-95 transition-all duration-300">
        <button onclick="closePopup()"
            class="absolute top-5 right-5 z-20 bg-white/80 hover:bg-red-500 hover:text-white w-10 h-10 flex items-center justify-center rounded-full shadow-lg transition-all">
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

                <img id="popImg" src="" class="w-full h-full object-cover transition-all duration-500"
                    alt="Banner">

                <div
                    class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent pointer-events-none z-10">
                </div>

                <div class="absolute bottom-6 left-8 right-8 z-20 pointer-events-none">
                    <div class="flex gap-2 mb-3">
                        <span id="popCapaian"
                            class="bg-yellow-400 text-blue-900 text-[10px] font-black px-4 py-1 rounded-full uppercase tracking-widest shadow-lg"></span>
                        <span id="popTingkat"
                            class="bg-blue-600 text-white text-[10px] font-black px-4 py-1 rounded-full uppercase tracking-widest shadow-lg"></span>
                    </div>
                    <h2 id="popTitle"
                        class="text-2xl md:text-3xl font-black text-white uppercase tracking-tight leading-tight"></h2>
                </div>
            </div>

            <div class="p-8 md:p-10">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100">
                        <h3
                            class="font-black text-blue-900 text-xs uppercase tracking-widest mb-6 border-b border-blue-100 pb-2">
                            <i class="fa fa-id-card mr-2"></i> Identitas Peserta
                        </h3>
                        <div class="space-y-5">
                            <div><label class="text-[10px] text-gray-400 font-bold uppercase block mb-1">Nama
                                    Lengkap</label>
                                <p id="popNama" class="font-bold text-gray-800 text-sm"></p>
                            </div>
                            <div><label class="text-[10px] text-gray-400 font-bold uppercase block mb-1">NIM / ID
                                    Mahasiswa</label>
                                <p id="popNim" class="font-bold text-gray-800 text-sm"></p>
                            </div>
                            <div><label class="text-[10px] text-gray-400 font-bold uppercase block mb-1">Program
                                    Studi</label>
                                <p id="popProdi" class="font-bold text-gray-800 text-sm"></p>
                            </div>
                            <div><label class="text-[10px] text-gray-400 font-bold uppercase block mb-1">Dosen
                                    Pembimbing</label>
                                <p id="popPembimbing" class="font-bold text-blue-700 text-sm"></p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100">
                        <h3
                            class="font-black text-blue-900 text-xs uppercase tracking-widest mb-6 border-b border-blue-100 pb-2">
                            <i class="fa fa-trophy mr-2"></i> Detail Kompetisi
                        </h3>
                        <div class="space-y-5">
                            <div><label
                                    class="text-[10px] text-gray-400 font-bold uppercase block mb-1">Penyelenggara</label>
                                <p id="popPenyelenggara" class="font-bold text-gray-800 text-sm"></p>
                            </div>
                            <div><label class="text-[10px] text-gray-400 font-bold uppercase block mb-1">Tanggal
                                    Perolehan</label>
                                <p id="popTanggal" class="font-bold text-gray-800 text-sm"></p>
                            </div>
                            <div><label class="text-[10px] text-gray-400 font-bold uppercase block mb-1">Lokasi /
                                    Tempat</label>
                                <p id="popTempat" class="font-bold text-gray-800 text-sm"></p>
                            </div>
                            <div><label class="text-[10px] text-gray-400 font-bold uppercase block mb-1">Status
                                    Sertifikat</label><span
                                    class="inline-flex items-center text-[10px] font-bold text-green-600 bg-green-100 px-2 py-0.5 rounded"><i
                                        class="fa fa-check-circle mr-1"></i> Terverifikasi</span></div>
                        </div>
                    </div>
                </div>

                <div class="mt-8">
                    <h3 class="font-black text-gray-800 text-xs uppercase tracking-widest mb-4">Ringkasan Kegiatan</h3>
                    <p
                        class="text-gray-600 text-sm leading-relaxed text-justify bg-white border border-gray-100 p-6 rounded-2xl">
                        Pencapaian ini merupakan hasil kerja keras mahasiswa yang bersangkutan di bawah bimbingan dosen
                        terkait. Kompetisi ini diikuti oleh berbagai institusi ternama dan melalui proses seleksi yang
                        ketat.
                    </p>
                </div>

                <div class="mt-10 flex flex-col md:flex-row justify-center gap-4">
                    <button
                        class="px-8 py-3 bg-[#1e3a8a] text-white font-bold rounded-xl hover:bg-black transition-all shadow-lg flex items-center justify-center">
                        <i class="fa fa-download mr-2"></i> Unduh Sertifikat
                    </button>
                    <button onclick="closePopup()"
                        class="px-8 py-3 bg-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-300 transition-all">Kembali</button>
                </div>
            </div>
        </div>
    </div>
</div>