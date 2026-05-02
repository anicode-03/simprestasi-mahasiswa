<section id="dashboard-section" class="flex gap-10 flex-1 overflow-hidden">

    <!-- Profile Card -->
    <div class="w-[45%] flex flex-col">
        <div class="profile-card flex flex-col items-center">
            <div class="profile-img-container">
                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Ani"
                    class="w-full h-full object-cover" alt="Foto profil Ani">
            </div>
            <div class="text-center w-full">
                <h2 class="text-2xl font-black text-slate-800 tracking-wide uppercase">{{ $user->name }}</h2>
                <div class="flex items-center justify-center gap-2 mt-2">
                    <span
                        class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-xs font-bold border border-blue-200 uppercase tracking-widest">{{ $user->mahasiswa->nim }}</span>
                </div>
                <div class="grid grid-cols-2 gap-4 mt-8">
                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200">
                        <span class="text-[10px] text-slate-400 font-bold uppercase block mb-1">Jurusan</span>
                        <span class="text-sm font-bold text-slate-700">{{ $user->mahasiswa->jurusan }}</span>
                    </div>
                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200">
                        <span class="text-[10px] text-slate-400 font-bold uppercase block mb-1">Prodi</span>
                        <span class="text-sm font-bold text-slate-700">{{ $user->mahasiswa->prodi }}</span>
                    </div>
                </div>
                <div class="mt-8 pt-8 border-t border-slate-200 flex items-center justify-center gap-3">
                    <div class="w-8 h-8 bg-blue-900 rounded-lg flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-white text-xs"></i>
                    </div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-[0.3em]">Politeknik Negeri
                        Jember</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Achievement Card -->
    <div class="flex-1 flex flex-col p-5">
        <div class="achievement-card p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold text-slate-800 flex items-center gap-3">
                    <i class="fas fa-star text-yellow-400"></i>
                    Riwayat Prestasi Terkini
                </h3>
                <a href="#" onclick="showSection('pengajuan'); switchFormTab('history'); return false;"
                    class="text-blue-600 text-sm font-semibold hover:underline">Lihat Semua</a>
            </div>
            <div class="podium-container">
                <svg viewBox="0 0 200 120" class="w-full max-w-[150px]" role="img"
                    aria-label="Ilustrasi podium juara">
                    <rect x="75" y="40" width="50" height="60" fill="#e2e8f0" rx="4" />
                    <rect x="25" y="60" width="50" height="40" fill="#cbd5e1" rx="4" />
                    <rect x="125" y="70" width="50" height="30" fill="#94a3b8" rx="4" />
                    <text x="94" y="75" font-weight="800" font-size="20" fill="#1e3a8a">1</text>
                    <text x="44" y="85" font-weight="800" font-size="16" fill="#475569">2</text>
                    <text x="144" y="90" font-weight="800" font-size="14" fill="#1e293b">3</text>
                    <path d="M92 20 L108 20 L104 35 L96 35 Z" fill="#fbbf24" />
                    <circle cx="100" cy="15" r="8" fill="#fbbf24" />
                </svg>
            </div>
            <div class="scroll-area space-y-2">
                <!-- Item 1 -->
                <div
                    class="flex gap-4 p-4 rounded-2xl border border-slate-200 hover:border-blue-200 hover:bg-blue-50/50 transition-all">
                    <div
                        class="flex-shrink-0 w-12 h-12 bg-amber-50 border border-amber-100 rounded-xl flex items-center justify-center text-amber-500">
                        <i class="fas fa-award text-2xl"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="badge-rank badge-gold">Juara 1</span>
                            <span
                                class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">Internasional</span>
                        </div>
                        <h4 class="font-bold text-slate-800 text-sm leading-snug">Robotics and Automation
                            Competition</h4>
                        <p class="text-xs text-slate-500 mt-1">Shanghai Jiao Tong University • Shanghai, China
                            (2026)</p>
                    </div>
                </div>
                <!-- Item 2 -->
                <div
                    class="flex gap-4 p-4 rounded-2xl border border-slate-200 hover:border-blue-200 hover:bg-blue-50/50 transition-all">
                    <div
                        class="flex-shrink-0 w-12 h-12 bg-slate-50 border border-slate-200 rounded-xl flex items-center justify-center text-slate-500">
                        <i class="fas fa-medal text-2xl"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="badge-rank badge-bronze">Juara 3</span>
                            <span
                                class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">Internal</span>
                        </div>
                        <h4 class="font-bold text-slate-800 text-sm leading-snug">Student Dance Fest 2026: Feel
                            the Beat</h4>
                        <p class="text-xs text-slate-500 mt-1">Politeknik Negeri Jember • Jember, Indonesia
                            (2026)</p>
                    </div>
                </div>
                <!-- Item 3 -->
                <div
                    class="flex gap-4 p-4 rounded-2xl border border-slate-200 hover:border-blue-200 hover:bg-blue-50/50 transition-all">
                    <div
                        class="flex-shrink-0 w-12 h-12 bg-orange-50 border border-orange-100 rounded-xl flex items-center justify-center text-orange-400">
                        <i class="fas fa-certificate text-2xl"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="badge-rank badge-silver">Harapan 2</span>
                            <span
                                class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">Internal</span>
                        </div>
                        <h4 class="font-bold text-slate-800 text-sm leading-snug">Pekan Seni Mahasiswa (Lukis
                            Realist)</h4>
                        <p class="text-xs text-slate-500 mt-1">Politeknik Negeri Jember • Jember, Indonesia
                            (2026)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>