<header class="flex justify-between items-center -mt-3">
    <div>
        <h1 id="header-title" class="text-2xl font-extrabold text-slate-800 tracking-tight">
            Selamat Datang, <span class="text-blue-700">{{ $user->name }}!</span>
        </h1>
        <p id="header-subtitle" class="text-sm text-slate-500">Pantau terus perkembangan prestasimu hari ini.
        </p>
    </div>
    <div class="flex items-center gap-2">
        <button
            class="relative h-10 w-10 flex items-center justify-center bg-white border border-slate-200 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-blue-600 hover:border-blue-200 transition-all duration-200 shadow-sm"
            aria-label="Notifikasi">

            <i class="fas fa-bell text-lg"></i>

            <span class="absolute top-2 right-2 flex h-2.5 w-2.5">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500 border-2 border-white"></span>
            </span>
        </button>
        <div
            class="h-10 w-10 bg-blue-100 rounded-xl flex items-center justify-center text-blue-700 font-bold border border-blue-200">
            {{ $user->initials }}
        </div>
    </div>
</header>
