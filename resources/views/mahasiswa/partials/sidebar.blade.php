<aside class="sidebar w-72 flex flex-col py-8 pl-6 text-white shrink-0">
    <div class="p-8">
        <div class="flex items-center -ml-5 -mt-8">
            <div class="p-2 rounded-xl -ml-1">
                <div class="w-10 h-10 flex items-center justify-center">
                    <img src="{{ asset('assets/img/logo.png') }}" class="w-10 h-10 object-contain" alt="Polije Logo">
                </div>
            </div>
            <div class="ml-1">
                <h1 class="font-extrabold text-sm tracking-tight leading-none text-white">SIMPRESMA</h1>
                <p class="text-[10px] text-blue-200 font-medium tracking-widest uppercase mt-1">Politeknik Negeri Jember
                </p>
            </div>
        </div>
    </div>

    <nav class="flex-1 space-y-2" role="navigation" aria-label="Menu utama">
        <a href="javascript:void(0)" onclick="showSection('dashboard')" tabindex="0" role="menuitem"
            aria-current="page" class="nav-link active flex items-center space-x-4 py-4 px-6">
            <i class="fas fa-th-large" aria-hidden="true"></i><span>Dashboard</span>
        </a>
        <a href="javascript:void(0)" onclick="showSection('pengajuan')" tabindex="0" role="menuitem"
            class="nav-link flex items-center space-x-4 py-4 px-6 opacity-70 hover:opacity-100">
            <i class="fas fa-paper-plane" aria-hidden="true"></i><span>Pengajuan</span>
        </a>
        <a href="javascript:void(0)" onclick="showSection('pengaturan')" tabindex="0" role="menuitem"
            class="nav-link flex items-center space-x-4 py-4 px-6 opacity-70 hover:opacity-100">
            <i class="fas fa-cog" aria-hidden="true"></i><span>Pengaturan</span>
        </a>
    </nav>

    <div class="logoutSystem p-6 -mb-10 -ml-5 flex items-center gap-2">
        <a href="{{ route('welcome') }}" title="Kembali ke Beranda"
            class="flex items-center justify-center w-11 h-11 bg-white/10 hover:bg-white/20 text-white rounded-xl transition-all border border-white/10 shrink-0">
            <i class="fas fa-home text-sm" aria-hidden="true"></i>
        </a>
        <form method="POST" action="{{ route('logout') }}" class="flex-1">
            @csrf
            <button type="submit" onclick="return confirmLogout(event)"
                class="w-full flex items-center justify-center gap-2 bg-red-500/10 hover:bg-red-500/20 text-red-200 py-3 rounded-xl transition-all">
                <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                <span class="font-semibold text-sm">Keluar Sistem</span>
            </button>
        </form>
    </div>
</aside>
