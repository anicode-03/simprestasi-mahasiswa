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
            class="relative p-2 bg-white border border-slate-200 rounded-xl text-slate-600 hover:bg-slate-50 transition-colors"
            aria-label="Notifikasi">
            <i class="fas fa-bell"></i>
            <span class="absolute top-3 right-2 w-2 h-2 bg-red-500 border-2 border-white rounded-full"></span>
        </button>
        <div
            class="h-10 w-10 bg-blue-100 rounded-xl flex items-center justify-center text-blue-700 font-bold border border-blue-200">
            AR</div>
    </div>
</header>