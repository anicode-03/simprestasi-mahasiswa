{{-- resources/views/mahasiswa/partials/section-pengaturan.blade.php --}}
<section id="pengaturan-section" class="hidden flex-1 overflow-y-auto custom-scroll pr-4 pb-10">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-1">
            <div class="bg-white rounded-[40px] p-8 border border-slate-200 shadow-sm text-center">
                <h3 class="text-sm font-black text-slate-400 uppercase tracking-[0.2em] mb-8">Foto Profil</h3>
                <div class="relative inline-block">
                    <div class="w-40 h-40 rounded-full border-8 border-slate-50 overflow-hidden shadow-inner mx-auto bg-slate-100">
                        <img id="current-avatar" src="https://api.dicebear.com/7.x/avataaars/svg?seed=Ani" class="w-full h-full object-cover" alt="Avatar profil saat ini">
                    </div>
                    <button type="button" onclick="toggleAvatarModal()"
                        class="absolute bottom-1 right-1 w-10 h-10 bg-blue-700 text-white rounded-full flex items-center justify-center hover:bg-blue-800 transition-all shadow-lg border-4 border-white"
                        aria-label="Ganti foto profil" title="Ganti foto profil">
                        <i class="fas fa-sync-alt text-xs" aria-hidden="true"></i>
                    </button>
                </div>
                <p class="mt-6 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Pilih dari template tersedia</p>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white rounded-[40px] p-10 border border-slate-200 shadow-sm">
                <div class="flex justify-between items-center mb-10">
                    <div>
                        <h3 class="text-xl font-black text-slate-800 tracking-tight">Informasi Akun</h3>
                        <p class="text-sm text-slate-400 mt-1">Perbarui detail profil dan kontak pribadi Anda.</p>
                    </div>
                    <i class="fas fa-user-shield text-3xl text-slate-100" aria-hidden="true"></i>
                </div>

                <form id="profil-form" action="{{ route('mahasiswa.profil.update') }}" method="POST" class="space-y-6" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="email" class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Alamat Email</label>
                            <div class="relative flex items-center">
                                <i class="fas fa-envelope absolute left-5 text-slate-300" aria-hidden="true"></i>
                                <input type="email" id="email" name="email"
                                    value="{{ Auth::user()->email }}" required
                                    class="w-full pl-12 pr-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:ring-4 focus:ring-blue-500/5 outline-none font-bold text-slate-700 transition-colors"
                                    aria-describedby="err-email">
                            </div>
                            <p class="field-error" id="err-email">Format email tidak valid.</p>
                        </div>
                        <div class="space-y-2">
                            <label for="no_hp" class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Nomor WhatsApp</label>
                            <div class="relative flex items-center">
                                <i class="fab fa-whatsapp absolute left-5 text-slate-300" aria-hidden="true"></i>
                                <input type="text" id="no_hp" name="no_hp"
                                    value="{{ Auth::user()->no_hp ?? '' }}"
                                    class="w-full pl-12 pr-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:ring-4 focus:ring-blue-500/5 outline-none font-bold text-slate-700 transition-colors">
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="alamat" class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Alamat Domisili</label>
                        <textarea id="alamat" name="alamat" rows="3"
                            class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:ring-4 focus:ring-blue-500/5 outline-none font-medium text-slate-700 transition-colors">{{ Auth::user()->alamat ?? '' }}</textarea>
                    </div>

                    <div class="pt-6 border-t border-slate-100">
                        <div class="flex items-center gap-4 p-4 bg-blue-50/50 rounded-2xl border border-blue-100 mb-6">
                            <i class="fas fa-info-circle text-blue-500" aria-hidden="true"></i>
                            <p class="text-xs font-semibold text-blue-700">Kosongkan kata sandi jika tidak ingin mengubahnya.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="new_password" class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Kata Sandi Baru</label>
                                <input type="password" id="new_password" name="new_password" placeholder="••••••••"
                                    class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm outline-none transition-colors"
                                    oninput="updatePasswordStrength(this.value)"
                                    aria-describedby="pw-strength-label">
                                <div class="mt-2 px-1">
                                    <div class="w-full bg-slate-100 rounded-full h-1">
                                        <div id="pw-strength-bar"></div>
                                    </div>
                                    <p id="pw-strength-label" class="text-[10px] font-bold mt-1 text-slate-400"></p>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label for="confirm_password" class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Konfirmasi Sandi</label>
                                <input type="password" id="confirm_password" name="confirm_password" placeholder="••••••••"
                                    class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm outline-none transition-colors"
                                    aria-describedby="err-confirm">
                                <p class="field-error" id="err-confirm">Kata sandi tidak cocok.</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-4 pt-6">
                        <button type="submit" id="profil-submit-btn"
                            class="flex-1 py-4 bg-blue-700 text-white rounded-2xl font-bold shadow-lg shadow-blue-200 hover:bg-blue-800 transition-all flex items-center justify-center gap-2">
                            <div class="btn-spinner" id="profil-spinner" aria-hidden="true"></div>
                            <i class="fas fa-save" id="profil-icon" aria-hidden="true"></i>
                            <span id="profil-label">Simpan Perubahan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>