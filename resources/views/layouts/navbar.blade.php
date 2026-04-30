<nav class="bg-[#1e3a8a] sticky top-0 z-50 shadow-sm border-b border-blue-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('assets/img/logo.png') }}" class="w-10 h-10" alt="Logo">
                <span class="font-extrabold text-xl text-white tracking-tight">SIMPRESMA - POLIJE</span>
            </div>

            <div class="hidden md:flex items-center space-x-10">
                <a href="{{ url('/') }}"
                    class="nav-link {{ Request::is('/') && !Request::is('#tentang') ? 'active' : '' }} text-white font-bold text-xs tracking-widest py-1">
                    BERANDA
                </a>

                <a href="{{ url('/') }}#tentang" id="nav-tentang"
                    class="nav-link text-blue-100 hover:text-white font-bold text-xs tracking-widest transition-all">
                    TENTANG SIMPRESMA-POLIJE
                </a>

                <a href="{{ url('/kontak') }}"
                    class="nav-link {{ Request::is('kontak') ? 'active' : '' }} text-blue-100 hover:text-white font-bold text-xs tracking-widest transition-all">
                    KONTAK
                </a>

                @guest
                    <div class="flex items-center -space-x-1 ml-4">
                        <a href="{{ route('login') }}"
                            class="px-4 py-1.5 text-xs font-bold btn-nav-outline rounded transition-all inline-block">LOGIN</a>
                        <a href="{{ route('register') }}"
                            class="px-4 py-1.5 text-xs font-bold btn-nav-outline bg-white text-[#1e3a8a] rounded hover:bg-blue-50 transition-all inline-block">SIGN
                            UP</a>
                    </div>
                @else
                    <div class="ml-4">
                        <a href="{{ route('dashboard') }}"
                            class="px-4 py-1.5 text-xs font-bold btn-nav-outline bg-white text-[#1e3a8a] rounded hover:bg-blue-50 transition-all inline-block">
                            DASHBOARD
                        </a>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</nav>
