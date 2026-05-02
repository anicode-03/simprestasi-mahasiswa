<section id="pengaturan-section" class="hidden flex-1 overflow-y-auto custom-scroll pr-4 pb-10">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-1">
            <div class="bg-white rounded-[40px] p-8 border border-slate-200 text-center">
                <h3 class="text-sm font-black text-slate-400 uppercase tracking-[0.2em] mb-8">Foto Profil</h3>
                <div class="relative inline-block">
                    <div class="w-40 h-40 rounded-full border-4 border-slate-200 overflow-hidden mx-auto bg-slate-100">
                        {{-- Mengambil avatar_url dari tabel mahasiswas --}}
                        <img id="current-avatar" src="{{ auth()->user()->mahasiswa->avatar_url ?? 'https://api.dicebear.com/7.x/avataaars/svg?seed=' . auth()->user()->name }}"
                            class="w-full h-full object-cover" alt="Avatar profil saat ini">
                    </div>
                    <button type="button" onclick="toggleAvatarModal()"
                        class="absolute bottom-1 right-1 w-10 h-10 bg-blue-700 text-white rounded-full flex items-center justify-center hover:bg-blue-800 transition-all border-4 border-white"
                        aria-label="Ganti foto profil">
                        <i class="fas fa-sync-alt text-xs"></i>
                    </button>
                </div>
                <p class="mt-6 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Pilih dari template tersedia</p>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white rounded-[40px] p-10 border border-slate-200">
                <div class="flex justify-between items-center mb-10">
                    <div>
                        <h3 class="text-xl font-black text-slate-800 tracking-tight">Informasi Akun</h3>
                        <p class="text-sm text-slate-400 mt-1">Perbarui detail profil dan kontak pribadi Anda.</p>
                    </div>
                    <i class="fas fa-user-shield text-3xl text-slate-200"></i>
                </div>

                {{-- Update route ke grup mahasiswa --}}
                <form id="profil-form" action="{{ route('mahasiswa.profile.update') }}" method="POST" class="space-y-6" novalidate>
                    @csrf
                    @method('PUT')
                    
                    {{-- Input hidden untuk avatar --}}
                    <input type="hidden" name="avatar" id="avatar-input-hidden" value="{{ auth()->user()->mahasiswa->avatar_url }}">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Email (dari tabel users) --}}
                        <div class="space-y-2">
                            <label for="email" class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Alamat Email</label>
                            <div class="relative flex items-center">
                                <i class="fas fa-envelope absolute left-5 text-slate-300"></i>
                                <input type="email" id="email" name="email"
                                    value="{{ old('email', auth()->user()->email) }}" required
                                    class="w-full pl-12 pr-6 py-4 bg-slate-50 border {{ $errors->has('email') ? 'border-red-500' : 'border-slate-200' }} rounded-2xl text-sm focus:ring-4 focus:ring-blue-500/5 outline-none font-bold text-slate-700 transition-colors">
                            </div>
                            @error('email')
                                <p class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- WhatsApp (dari tabel mahasiswas) --}}
                        <div class="space-y-2">
                            <label for="no_hp" class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Nomor WhatsApp</label>
                            <div class="relative flex items-center">
                                <i class="fab fa-whatsapp absolute left-5 text-slate-300"></i>
                                <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp', auth()->user()->mahasiswa->no_hp ?? '') }}"
                                    class="w-full pl-12 pr-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:ring-4 focus:ring-blue-500/5 outline-none font-bold text-slate-700 transition-colors">
                            </div>
                        </div>
                    </div>

                    {{-- Alamat (dari tabel mahasiswas) --}}
                    <div class="space-y-2">
                        <label for="alamat" class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Alamat Domisili</label>
                        <textarea id="alamat" name="alamat" rows="3"
                            class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:ring-4 focus:ring-blue-500/5 outline-none font-medium text-slate-700 transition-colors">{{ old('alamat', auth()->user()->mahasiswa->alamat ?? '') }}</textarea>
                    </div>

                    <div class="pt-6 border-t border-slate-200">
                        <div class="flex items-center gap-4 p-4 bg-blue-50 rounded-2xl border border-blue-100 mb-6">
                            <i class="fas fa-info-circle text-blue-500"></i>
                            <p class="text-xs font-semibold text-blue-700">Kosongkan kata sandi jika tidak ingin mengubahnya.</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="new_password" class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Kata Sandi Baru</label>
                                <input type="password" id="new_password" name="new_password" placeholder="••••••••"
                                    class="w-full px-6 py-4 bg-slate-50 border {{ $errors->has('new_password') ? 'border-red-500' : 'border-slate-200' }} rounded-2xl text-sm outline-none transition-colors">
                                @error('new_password')
                                    <p class="text-red-500 text-[10px] font-bold mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="confirm_password" class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Konfirmasi Sandi</label>
                                <input type="password" id="confirm_password" name="new_password_confirmation" placeholder="••••••••"
                                    class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm outline-none transition-colors">
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-4 pt-6">
                        <button type="submit" id="profil-submit-btn"
                            class="flex-1 py-4 bg-blue-700 text-white rounded-2xl font-bold hover:bg-blue-800 transition-all flex items-center justify-center gap-2">
                            <i class="fas fa-save" id="profil-icon"></i>
                            <span id="profil-label">Simpan Perubahan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>