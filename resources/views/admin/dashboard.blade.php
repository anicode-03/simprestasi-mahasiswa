<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPRESMA POLIJE | Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');

        :root { --primary: #1e3a8a; --primary-hover: #172e6e; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-primary { background-color: var(--primary); }
        .text-primary { color: var(--primary); }
        .border-primary { border-color: var(--primary); }

        .sidebar { background-color: #1e3a8a; transition: all 0.3s ease; }
        .nav-link { transition: all 0.3s ease; position: relative; }
        .nav-link.active { background: white; color: #1e3a8a; border-radius: 30px 0 0 30px; font-weight: 700; }
        .nav-link.active::after { content: ''; position: absolute; right: 0; top: -30px; width: 30px; height: 30px; background: transparent; border-radius: 50%; box-shadow: 15px 15px 0 white; }
        .nav-link.active::before { content: ''; position: absolute; right: 0; bottom: -30px; width: 30px; height: 30px; background: transparent; border-radius: 50%; box-shadow: 15px -15px 0 white; }

        .card-shadow { box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05), 0 8px 10px -6px rgba(0,0,0,0.05); }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }

        .btn-action { transition: all 0.2s cubic-bezier(0.4,0,0.2,1); }
        .btn-action:hover { transform: scale(1.05); filter: brightness(1.1); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); }
        .btn-action:active { transform: scale(0.95); }

        .modal-overlay { transition: opacity 0.25s ease; }
        .modal-box { transition: transform 0.3s cubic-bezier(0.34,1.56,0.64,1), opacity 0.25s ease; }
        .modal-overlay.hidden .modal-box { transform: scale(0.85) translateY(20px); opacity: 0; }

        #toast-container { position: fixed; bottom: 24px; right: 24px; z-index: 9999; display: flex; flex-direction: column; gap: 10px; }
        .toast { display: flex; align-items: center; gap: 12px; padding: 14px 20px; border-radius: 16px; font-size: 13px; font-weight: 700; color: white; box-shadow: 0 8px 32px rgba(0,0,0,0.15); animation: slideIn 0.4s cubic-bezier(0.34,1.56,0.64,1); min-width: 260px; }
        .toast.success { background: #10b981; }
        .toast.error { background: #ef4444; }
        .toast.info { background: #1e3a8a; }
        @keyframes slideIn { from { transform: translateX(100px); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
        @keyframes fadeOut { from { opacity: 1; } to { opacity: 0; transform: translateX(40px); } }
        .toast.removing { animation: fadeOut 0.3s ease forwards; }

        .data-row { transition: background 0.15s ease; }
        .data-row:hover { background: #f8fafc; }

        .kategori-item { transition: all 0.2s ease; }
        .kategori-item:hover { background: #f0f4ff; transform: translateX(2px); }

        @keyframes shake { 0%,100%{transform:translateX(0)} 20%{transform:translateX(-6px)} 40%{transform:translateX(6px)} 60%{transform:translateX(-4px)} 80%{transform:translateX(4px)} }
        .shake { animation: shake 0.4s ease; }

        .badge { display: inline-flex; align-items: center; padding: 3px 10px; border-radius: 9999px; font-size: 10px; font-weight: 800; letter-spacing: 0.04em; text-transform: uppercase; }

        .form-input { width: 100%; padding: 10px 14px; background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 12px; font-size: 13px; outline: none; transition: border-color 0.2s, box-shadow 0.2s; }
        .form-input:focus { border-color: #1e3a8a; box-shadow: 0 0 0 4px rgba(30,58,138,0.08); }

        .confirm-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 10000; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(4px); }
        .confirm-box { background: white; border-radius: 24px; padding: 32px; max-width: 380px; width: 90%; box-shadow: 0 25px 60px rgba(0,0,0,0.2); text-align: center; }
    </style>
</head>

<body class="h-full overflow-hidden">
<div id="toast-container"></div>

<div id="confirmDialog" class="confirm-overlay hidden">
    <div class="confirm-box shake-target">
        <div id="confirmIcon" class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl"></div>
        <h3 id="confirmTitle" class="text-lg font-black text-slate-800 mb-2"></h3>
        <p id="confirmMsg" class="text-sm text-slate-500 font-medium mb-6"></p>
        <div class="flex gap-3">
            <button onclick="cancelConfirm()" class="flex-1 py-3 border border-slate-200 rounded-2xl text-sm font-bold text-slate-600 hover:bg-slate-50 transition-all">Batal</button>
            <button id="confirmOkBtn" class="flex-1 py-3 rounded-2xl text-sm font-black text-white transition-all">Ya, Lanjutkan</button>
        </div>
    </div>
</div>

<div class="flex h-screen">
    <!-- SIDEBAR -->
    <aside class="sidebar w-72 flex flex-col py-8 pl-6 text-white shrink-0">
        <div class="p-8">
            <div class="flex items-center -ml-5 -mt-8">
                <div class="p-2 rounded-xl -ml-1">
                    <div class="w-10 h-10 flex items-center justify-center">
                        <img src="asset/img/logo.png" class="w-10 h-10 object-contain" alt="Polije Logo">
                    </div>
                </div>
                <div class="ml-1">
                    <h1 class="font-extrabold text-sm tracking-tight leading-none text-white">SIMPRESMA</h1>
                    <p class="text-[10px] text-blue-200 font-medium tracking-widest uppercase mt-1">Politeknik Negeri Jember</p>
                </div>
            </div>
        </div>

        <nav class="flex-1 space-y-2">
            <a href="#" onclick="switchTab('Dashboard')" class="nav-link active flex items-center space-x-4 py-4 px-6">
                <i class="fas fa-th-large"></i><span>Dashboard</span>
            </a>
            <a href="#" onclick="switchTab('Verifikasi')" class="nav-link flex items-center space-x-4 py-4 px-6 opacity-70 hover:opacity-100">
                <i class="fas fa-clipboard-check"></i><span>Verifikasi</span>
            </a>
            <a href="#" onclick="switchTab('Data Prestasi')" class="nav-link flex items-center space-x-4 py-4 px-6 opacity-70 hover:opacity-100">
                <i class="fas fa-trophy"></i><span>Data Prestasi</span>
            </a>
            <a href="#" onclick="switchTab('Data Mahasiswa')" class="nav-link flex items-center space-x-4 py-4 px-6 opacity-70 hover:opacity-100">
                <i class="fas fa-user-graduate"></i><span>Data Mahasiswa</span>
            </a>
            <a href="#" onclick="switchTab('Data Jurusan')" class="nav-link flex items-center space-x-4 py-4 px-6 opacity-70 hover:opacity-100">
                <i class="fas fa-university"></i><span>Data Jurusan</span>
            </a>
            <a href="#" onclick="switchTab('Kategori')" class="nav-link flex items-center space-x-4 py-4 px-6 opacity-70 hover:opacity-100">
                <i class="fas fa-tags"></i><span>Kategori</span>
            </a>
        </nav>

        <div class="logoutSystem p-6 -mb-10 -ml-5 flex items-center gap-2">
            <a href="{{ route('welcome') }}" title="Kembali ke Beranda" class="flex items-center justify-center w-11 h-11 bg-white/10 hover:bg-white/20 text-white rounded-xl transition-all border border-white/10 shrink-0">
                <i class="fas fa-home text-sm" aria-hidden="true"></i>
            </a>
            <form method="POST" action="{{ route('logout') }}" class="flex-1">
                @csrf
                <button type="submit" onclick="return confirmLogout(event)" class="w-full flex items-center justify-center gap-2 bg-red-500/10 hover:bg-red-500/20 text-red-200 py-3 rounded-xl transition-all">
                    <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                    <span class="font-semibold text-sm">Keluar Sistem</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 flex flex-col bg-[#F8FAFC]">
        <header class="bg-white h-20 flex items-center justify-between px-10 border-b border-slate-200 shadow-sm z-10">
            <div class="flex items-center space-x-4">
                <h2 id="pageTitle" class="text-2xl font-extrabold text-primary">{{ __('Dashboard Admin')}}</h2>
            </div>
            <div class="flex items-center space-x-6">
                <div class="relative cursor-pointer" onclick="showToast('Tidak ada notifikasi baru.','info')">
                    <i class="fas fa-bell text-slate-400 text-lg"></i>
                    <span class="absolute -top-1 -right-1 w-2 h-2 bg-rose-500 rounded-full"></span>
                </div>
                <div class="flex items-center space-x-3 border-l pl-6">
                    <div class="text-right">
                        <p class="text-xs font-extrabold text-slate-800">Halo, {{ Auth::user()->name }} (Admin)!</p>
                        <p class="text-[10px] text-slate-400 font-bold uppercase">
                            <strong>Email:</strong> {{ Auth::user()->email }}
                        </p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-primary border border-slate-200">
                        <i class="fas fa-user-shield"></i>
                    </div>
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-10">

            <!-- ==================== DASHBOARD ==================== -->
            <section id="dashboardTab" class="space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-white p-6 rounded-[2rem] border border-slate-100 card-shadow flex items-center space-x-4">
                        <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-xl"><i class="fas fa-award"></i></div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Prestasi</p>
                            <h3 class="text-2xl font-black text-slate-800" id="dashTotalPrestasi">1,432</h3>
                            <p class="text-[10px] text-emerald-500 font-bold"><i class="fas fa-arrow-up"></i> 12% thd bulan lalu</p>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-[2rem] border border-slate-100 card-shadow flex items-center space-x-4">
                        <div class="w-14 h-14 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center text-xl"><i class="fas fa-clock"></i></div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Menunggu Verif</p>
                            <h3 class="text-2xl font-black text-slate-800">12</h3>
                            <p class="text-[10px] text-rose-500 font-bold">Butuh tindakan segera</p>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-[2rem] border border-slate-100 card-shadow flex items-center space-x-4">
                        <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center text-xl"><i class="fas fa-users"></i></div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Mahasiswa Aktif</p>
                            <h3 class="text-2xl font-black text-slate-800">8,540</h3>
                            <p class="text-[10px] text-slate-400 font-bold">Tersebar di 21 Prodi</p>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-[2rem] border border-slate-100 card-shadow flex items-center space-x-4">
                        <div class="w-14 h-14 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center text-xl"><i class="fas fa-globe"></i></div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Internasional</p>
                            <h3 class="text-2xl font-black text-slate-800">24</h3>
                            <p class="text-[10px] text-emerald-500 font-bold">Tahun Akademik 2024</p>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2 bg-white p-8 rounded-[2.5rem] card-shadow border border-slate-100">
                        <div class="flex items-center justify-between mb-8">
                            <div>
                                <h4 class="text-lg font-black text-slate-800">Tren Pertumbuhan Prestasi</h4>
                                <p class="text-xs text-slate-400 font-medium">Statistik akumulasi prestasi per bulan tahun 2024</p>
                            </div>
                            <select class="bg-slate-50 border-none text-xs font-bold text-slate-600 rounded-lg px-3 py-2 outline-none">
                                <option>Tahun 2024</option><option>Tahun 2023</option>
                            </select>
                        </div>
                        <div class="h-72"><canvas id="trendChart"></canvas></div>
                    </div>
                    <div class="bg-white p-8 rounded-[2.5rem] card-shadow border border-slate-100">
                        <h4 class="text-lg font-black text-slate-800 mb-1">Performa Jurusan</h4>
                        <p class="text-xs text-slate-400 font-medium mb-8">Distribusi prestasi berdasarkan jurusan</p>
                        <div class="h-64 flex items-center justify-center"><canvas id="jurusanChart"></canvas></div>
                        <div class="mt-6 space-y-2">
                            <div class="flex items-center justify-between text-[10px] font-bold">
                                <span class="flex items-center"><span class="w-2 h-2 rounded-full bg-blue-800 mr-2"></span>Teknologi Informasi</span>
                                <span class="text-slate-600">450 Poin</span>
                            </div>
                            <div class="flex items-center justify-between text-[10px] font-bold">
                                <span class="flex items-center"><span class="w-2 h-2 rounded-full bg-blue-500 mr-2"></span>Teknik</span>
                                <span class="text-slate-600">320 Poin</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="bg-white p-8 rounded-[2.5rem] card-shadow border border-slate-100">
                        <div class="flex items-center justify-between mb-6">
                            <h4 class="text-lg font-black text-slate-800">Log Aktivitas Sistem</h4>
                            <button class="text-primary text-xs font-bold hover:underline">Lihat Semua</button>
                        </div>
                        <div class="space-y-6">
                            <div class="flex items-start space-x-4">
                                <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0 mt-1"><i class="fas fa-check text-xs"></i></div>
                                <div><p class="text-sm font-bold text-slate-700">Prestasi "Web Design" Disetujui</p><p class="text-[10px] text-slate-400 font-medium">Oleh Admin 1 • 2 Menit yang lalu</p></div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <div class="w-10 h-10 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center shrink-0 mt-1"><i class="fas fa-file-import text-xs"></i></div>
                                <div><p class="text-sm font-bold text-slate-700">Pengajuan Baru: Budi Santoso</p><p class="text-[10px] text-slate-400 font-medium">Lomba Inovasi TIK • 15 Menit yang lalu</p></div>
                            </div>
                            <div class="flex items-start space-x-4">
                                <div class="w-10 h-10 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center shrink-0 mt-1"><i class="fas fa-times text-xs"></i></div>
                                <div><p class="text-sm font-bold text-slate-700">Prestasi "Karate" Ditolak</p><p class="text-[10px] text-slate-400 font-medium">Sertifikat tidak valid • 1 Jam yang lalu</p></div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-8 rounded-[2.5rem] card-shadow border border-slate-100">
                        <div class="flex items-center justify-between mb-6">
                            <h4 class="text-lg font-black text-slate-800">Top Mahasiswa Berprestasi</h4>
                            <div class="flex space-x-2">
                                <button class="px-3 py-1 bg-primary text-white text-[10px] font-bold rounded-lg">Nasional</button>
                                <button class="px-3 py-1 bg-slate-50 text-slate-400 text-[10px] font-bold rounded-lg">Global</button>
                            </div>
                        </div>
                        <div class="overflow-hidden">
                            <table class="w-full">
                                <tbody class="divide-y divide-slate-50">
                                    <tr class="hover:bg-slate-50 transition-colors">
                                        <td class="py-3"><div class="flex items-center space-x-3"><div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center font-black text-primary text-xs">1</div><div><p class="text-xs font-bold text-slate-800">Rizky Ramadhan</p><p class="text-[9px] text-slate-400">Teknik Informatika</p></div></div></td>
                                        <td class="text-right py-3"><span class="text-xs font-black text-primary">450 Poin</span></td>
                                    </tr>
                                    <tr class="hover:bg-slate-50 transition-colors">
                                        <td class="py-3"><div class="flex items-center space-x-3"><div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center font-black text-slate-500 text-xs">2</div><div><p class="text-xs font-bold text-slate-800">Siti Aminah</p><p class="text-[9px] text-slate-400">Manajemen Informatika</p></div></div></td>
                                        <td class="text-right py-3"><span class="text-xs font-black text-primary">390 Poin</span></td>
                                    </tr>
                                    <tr class="hover:bg-slate-50 transition-colors">
                                        <td class="py-3"><div class="flex items-center space-x-3"><div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center font-black text-slate-500 text-xs">3</div><div><p class="text-xs font-bold text-slate-800">Kevin Pratama</p><p class="text-[9px] text-slate-400">Teknik Komputer</p></div></div></td>
                                        <td class="text-right py-3"><span class="text-xs font-black text-primary">310 Poin</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ==================== VERIFIKASI ==================== -->
            <section id="verifikasiTab" class="hidden space-y-8">
                <div class="flex items-center justify-between mb-2">
                    <div>
                        <h3 class="text-xl font-black text-slate-800">Menunggu Verifikasi</h3>
                        <p class="text-sm text-slate-400 font-medium">Terdapat <span class="text-primary font-bold">12 pengajuan</span> prestasi baru mahasiswa.</p>
                    </div>
                    <div class="flex space-x-3">
                        <button class="bg-white border border-slate-200 px-4 py-2 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-50 transition-all flex items-center space-x-2">
                            <i class="fas fa-filter"></i> <span>Filter</span>
                        </button>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-8">
                    <div class="bg-white border border-slate-100 rounded-[2.5rem] p-8 card-shadow relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-bl-[5rem] -mr-8 -mt-8"></div>
                        <div class="flex flex-col lg:flex-row gap-10">
                            <div class="flex flex-col items-center shrink-0 space-y-4">
                                <div class="w-44 h-56 bg-slate-100 rounded-3xl overflow-hidden border-4 border-white shadow-xl">
                                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Ani" class="w-full h-full object-cover" alt="Profile">
                                </div>
                                <span class="px-4 py-1.5 bg-amber-100 text-amber-600 text-[10px] font-black uppercase tracking-widest rounded-full">Pending</span>
                            </div>
                            <div class="flex-1">
                                <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 mb-6">
                                    <div>
                                        <h4 class="text-2xl font-black text-slate-800 mb-1">Ani Rizqi Ziarotus S.</h4>
                                        <p class="text-primary font-bold tracking-wider text-sm">E41251131 <span class="mx-2 text-slate-300">|</span> Teknik Informatika</p>
                                    </div>
                                    <div class="bg-primary/5 px-6 py-3 rounded-2xl border border-primary/10">
                                        <p class="text-[10px] font-black text-primary uppercase tracking-widest mb-1">Capaian Prestasi</p>
                                        <h5 class="text-lg font-extrabold text-slate-800 leading-tight">Juara 1 Olimpiade Internasional 2025</h5>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
                                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100"><p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Peringkat</p><p class="text-xs font-extrabold text-slate-700">Juara 1</p></div>
                                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100"><p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Kategori</p><p class="text-xs font-extrabold text-slate-700">Akademik</p></div>
                                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100"><p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Tingkat</p><p class="text-xs font-extrabold text-slate-700">Internasional</p></div>
                                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100"><p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Tanggal</p><p class="text-xs font-extrabold text-slate-700">23 Nov 2025</p></div>
                                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100"><p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Lokasi</p><p class="text-xs font-extrabold text-slate-700">Yogyakarta</p></div>
                                </div>
                                <div class="flex flex-col md:flex-row gap-6 items-center">
                                    <div class="flex-1 w-full bg-slate-100/50 p-4 rounded-2xl border border-dashed border-slate-300 flex items-center space-x-4">
                                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-slate-400 border"><i class="fas fa-university"></i></div>
                                        <div><p class="text-[9px] font-black text-slate-400 uppercase">Penyelenggara</p><p class="text-sm font-bold text-slate-700">Tokyo University Science</p></div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex lg:flex-col justify-center gap-3 shrink-0">
                                <button onclick="verifikasiAction('setujui','Ani Rizqi Ziarotus S.')" class="btn-action bg-emerald-500 text-white w-full lg:w-40 py-4 rounded-2xl font-black text-xs shadow-lg shadow-emerald-500/20 uppercase tracking-widest">SETUJUI</button>
                                <button onclick="verifikasiAction('tolak','Ani Rizqi Ziarotus S.')" class="btn-action bg-rose-500 text-white w-full lg:w-40 py-4 rounded-2xl font-black text-xs shadow-lg shadow-rose-500/20 uppercase tracking-widest">TOLAK</button>
                                <button onclick="verifikasiAction('revisi','Ani Rizqi Ziarotus S.')" class="btn-action bg-slate-800 text-white w-full lg:w-40 py-4 rounded-2xl font-black text-xs shadow-lg shadow-slate-800/20 uppercase tracking-widest">REVISI</button>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white border border-slate-100 rounded-[2.5rem] p-8 card-shadow">
                        <div class="flex flex-col lg:flex-row gap-10">
                            <div class="flex flex-col items-center shrink-0 space-y-4">
                                <div class="w-44 h-56 bg-slate-100 rounded-3xl overflow-hidden border-4 border-white shadow-xl">
                                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Erix" class="w-full h-full object-cover" alt="Profile">
                                </div>
                                <span class="px-4 py-1.5 bg-amber-100 text-amber-600 text-[10px] font-black uppercase tracking-widest rounded-full">Pending</span>
                            </div>
                            <div class="flex-1">
                                <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 mb-6">
                                    <div>
                                        <h4 class="text-2xl font-black text-slate-800 mb-1">Erix Agung Wibowo</h4>
                                        <p class="text-primary font-bold tracking-wider text-sm">E41251146 <span class="mx-2 text-slate-300">|</span> Teknologi Informasi</p>
                                    </div>
                                    <div class="bg-primary/5 px-6 py-3 rounded-2xl border border-primary/10">
                                        <p class="text-[10px] font-black text-primary uppercase tracking-widest mb-1">Capaian Prestasi</p>
                                        <h5 class="text-lg font-extrabold text-slate-800 leading-tight">Juara 2 Business Plan Competition</h5>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
                                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100"><p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Kategori</p><p class="text-xs font-extrabold text-slate-700">Wirausaha</p></div>
                                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100"><p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Tingkat</p><p class="text-xs font-extrabold text-slate-700">Nasional</p></div>
                                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100"><p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Peran</p><p class="text-xs font-extrabold text-slate-700">Anggota</p></div>
                                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100"><p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Tanggal</p><p class="text-xs font-extrabold text-slate-700">10 Okt 2025</p></div>
                                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100"><p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Lokasi</p><p class="text-xs font-extrabold text-slate-700">Yogyakarta</p></div>
                                </div>
                                <div class="flex flex-col md:flex-row gap-6 items-center">
                                    <div class="flex-1 w-full bg-slate-100/50 p-4 rounded-2xl border border-dashed border-slate-300 flex items-center space-x-4">
                                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-slate-400 border shadow-sm"><i class="fas fa-university"></i></div>
                                        <div><p class="text-[9px] font-black text-slate-400 uppercase">Penyelenggara</p><p class="text-sm font-bold text-slate-700">Universitas Gadjah Mada</p></div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex lg:flex-col justify-center gap-3 shrink-0">
                                <button onclick="verifikasiAction('setujui','Erix Agung Wibowo')" class="btn-action bg-emerald-500 text-white w-full lg:w-40 py-4 rounded-2xl font-black text-xs shadow-lg shadow-emerald-500/20 uppercase tracking-widest">SETUJUI</button>
                                <button onclick="verifikasiAction('tolak','Erix Agung Wibowo')" class="btn-action bg-rose-500 text-white w-full lg:w-40 py-4 rounded-2xl font-black text-xs shadow-lg shadow-rose-500/20 uppercase tracking-widest">TOLAK</button>
                                <button onclick="verifikasiAction('revisi','Erix Agung Wibowo')" class="btn-action bg-slate-800 text-white w-full lg:w-40 py-4 rounded-2xl font-black text-xs shadow-lg shadow-slate-800/20 uppercase tracking-widest">REVISI</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ==================== DATA PRESTASI ==================== -->
            <section id="dataprestasiTab" class="hidden space-y-6">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Data Prestasi Mahasiswa</h2>
                        <p class="text-slate-500 text-sm">Manajemen dan verifikasi data capaian mahasiswa.</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button onclick="renderPrestasiTable()" class="px-4 py-2 bg-white border border-slate-200 text-slate-600 rounded-xl text-xs font-bold hover:bg-slate-50 transition-all flex items-center gap-2">
                            <i class="fas fa-sync-alt"></i> Refresh
                        </button>
                        <!-- FIX: tombol ini sekarang memanggil openPrestasiModal() yang benar -->
                        <button onclick="openPrestasiModal()" class="px-4 py-2 bg-cyan-500 text-white rounded-xl text-xs font-bold hover:bg-cyan-600 transition-all flex items-center gap-2 shadow-lg shadow-cyan-100">
                            <i class="fas fa-plus"></i> Tambah Data Prestasi
                        </button>
                        <button onclick="showToast('File Excel sedang diekspor...','info')" class="px-4 py-2 bg-emerald-600 text-white rounded-xl text-xs font-bold hover:bg-emerald-700 transition-all flex items-center gap-2 shadow-lg shadow-emerald-100">
                            <i class="fas fa-file-excel"></i> Export Excel
                        </button>
                    </div>
                </div>

                <!-- Filter Bar -->
                <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm flex flex-col md:flex-row gap-4">
                    <div class="relative flex-1">
                        <span class="absolute inset-y-0 left-4 flex items-center text-slate-400"><i class="fas fa-search text-xs"></i></span>
                        <input type="text" id="searchFilter" placeholder="Cari berdasarkan Nama atau NIM..." class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all">
                    </div>
                    <div class="flex flex-wrap items-center gap-3">
                        <!-- FIX: filter Jurusan sekarang memakai value yang cocok dengan data -->
                        <select id="jurusanFilterPrestasi" class="px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-600 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all min-w-[140px]">
                            <option value="">Jurusan</option>
                            <option value="Teknologi Informasi">Teknologi Informasi</option>
                            <option value="Teknik">Teknik</option>
                            <option value="Pertanian">Pertanian</option>
                            <option value="Kesehatan">Kesehatan</option>
                        </select>
                        <select id="kategoriFilter" class="px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-600 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all min-w-[140px]">
                            <option value="">Kategori</option>
                            <option value="Akademik">Akademik</option>
                            <option value="Olahraga">Olahraga</option>
                            <option value="Sains">Sains</option>
                            <option value="Karya Ilmiah">Karya Ilmiah</option>
                            <option value="Wirausaha">Wirausaha</option>
                            <option value="Seni">Seni</option>
                        </select>
                        <select id="tingkatFilter" class="px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-600 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all min-w-[140px]">
                            <option value="">Tingkat</option>
                            <option value="Internasional">Internasional</option>
                            <option value="Nasional">Nasional</option>
                            <option value="Provinsi">Provinsi</option>
                            <option value="Kabupaten">Kabupaten</option>
                        </select>
                        <select id="tahunFilter" class="px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-600 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all">
                            <option value="">Tahun</option>
                            <option value="2026">2026</option>
                            <option value="2025">2025</option>
                            <option value="2024">2024</option>
                            <option value="2023">2023</option>
                        </select>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse" id="tablePrestasi">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                    <th class="px-6 py-5">NIM</th>
                                    <th class="px-6 py-5">Nama Mahasiswa</th>
                                    <th class="px-6 py-5">Prestasi</th>
                                    <th class="px-6 py-5">Lomba</th>
                                    <th class="px-6 py-5 text-center">Kategori</th>
                                    <th class="px-6 py-5 text-center">Tingkat</th>
                                    <th class="px-6 py-5 text-center">Tahun</th>
                                    <th class="px-6 py-5 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100" id="prestasiTableBody">
                                <!-- JS generated -->
                            </tbody>
                        </table>
                        <div id="noData" class="hidden p-16 text-center">
                            <i class="fas fa-folder-open text-4xl text-slate-200 mb-3 block"></i>
                            <p class="text-slate-400 text-sm font-medium italic">Tidak ada data yang sesuai dengan kriteria filter.</p>
                            <button onclick="resetFilters()" class="mt-4 text-xs font-bold text-indigo-600 hover:underline">Reset Semua Filter</button>
                        </div>
                    </div>
                    <div class="px-6 py-4 bg-slate-50 border-t border-slate-200 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Menampilkan <span id="visibleCount" class="text-slate-700">0</span> data</span>
                        <div class="flex items-center gap-1">
                            <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-400"><i class="fas fa-chevron-left text-[10px]"></i></button>
                            <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-indigo-900 text-white shadow-sm font-bold text-[10px]">1</button>
                            <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-600 font-bold text-[10px]">2</button>
                            <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-600 font-bold text-[10px]">3</button>
                            <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-600"><i class="fas fa-chevron-right text-[10px]"></i></button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ==================== DATA MAHASISWA ==================== -->
            <section id="datamahasiswaTab" class="hidden space-y-6">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Data Mahasiswa</h2>
                        <p class="text-slate-500 text-sm">Kelola data mahasiswa terdaftar di sistem.</p>
                    </div>
                    <div class="flex items-center gap-2 flex-wrap">
                        <button onclick="showToast('Mengimpor data dari Excel...','info')" class="px-4 py-2 bg-indigo-600 text-white rounded-xl text-xs font-bold hover:bg-indigo-700 transition-all flex items-center gap-2 shadow-lg shadow-indigo-100">
                            <i class="fas fa-file-excel"></i> Impor Excel
                        </button>
                        <button onclick="showToast('Mengekspor ke PDF...','info')" class="px-4 py-2 bg-emerald-600 text-white rounded-xl text-xs font-bold hover:bg-emerald-700 transition-all flex items-center gap-2 shadow-lg shadow-emerald-100">
                            <i class="fas fa-file-pdf"></i> Ekspor PDF
                        </button>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm flex flex-col md:flex-row gap-3 items-center">
                    <span class="text-xs font-black text-slate-400 uppercase tracking-widest shrink-0">Filter</span>
                    <select id="mhsJurusanFilter" class="px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-600 outline-none min-w-[150px]">
                        <option value="">Semua Jurusan</option>
                        <option value="Teknologi Informasi">Teknologi Informasi</option>
                        <option value="Pertanian">Pertanian</option>
                        <option value="Kesehatan">Kesehatan</option>
                    </select>
                    <select id="mhsAngkatanFilter" class="px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-600 outline-none min-w-[130px]">
                        <option value="">Semua Angkatan</option>
                        <option value="2025">2025</option>
                        <option value="2024">2024</option>
                        <option value="2023">2023</option>
                    </select>
                    <select id="mhsStatusFilter" class="px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-600 outline-none min-w-[130px]">
                        <option value="">Semua Status</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Cuti">Cuti</option>
                        <option value="Lulus">Lulus</option>
                    </select>
                    <div class="relative flex-1 w-full">
                        <span class="absolute inset-y-0 left-4 flex items-center text-slate-400"><i class="fas fa-search text-xs"></i></span>
                        <input type="text" id="mhsSearchInput" placeholder="Cari NIM atau Nama..." class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs outline-none focus:border-primary transition-all">
                    </div>
                </div>
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                    <th class="px-6 py-5">NIM</th>
                                    <th class="px-6 py-5">Nama</th>
                                    <th class="px-6 py-5">Jurusan</th>
                                    <th class="px-6 py-5 text-center">Angkatan</th>
                                    <th class="px-6 py-5 text-center">Status</th>
                                    <th class="px-6 py-5 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="mhsTableBody" class="divide-y divide-slate-100"></tbody>
                        </table>
                        <div id="mhsNoData" class="hidden p-16 text-center">
                            <i class="fas fa-user-slash text-4xl text-slate-200 mb-3 block"></i>
                            <p class="text-slate-400 text-sm font-medium italic">Tidak ada mahasiswa yang sesuai dengan filter.</p>
                        </div>
                    </div>
                    <div class="px-6 py-4 bg-slate-50 border-t border-slate-200 flex items-center justify-between">
                        <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Menampilkan <span id="mhsCount" class="text-slate-700">0</span> data</span>
                        <div class="flex items-center gap-1">
                            <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-400"><i class="fas fa-chevron-left text-[10px]"></i></button>
                            <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-indigo-900 text-white font-bold text-[10px]">1</button>
                            <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-600 font-bold text-[10px]">2</button>
                            <button class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-600"><i class="fas fa-chevron-right text-[10px]"></i></button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ==================== DATA JURUSAN ==================== -->
            <section id="datajurusanTab" class="hidden space-y-6">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Data Jurusan</h2>
                        <p class="text-slate-500 text-sm">Kelola data jurusan dan program studi.</p>
                    </div>
                    <button onclick="openJurusanModal()" class="px-4 py-2 bg-cyan-500 text-white rounded-xl text-xs font-bold hover:bg-cyan-600 transition-all flex items-center gap-2 shadow-lg shadow-cyan-100">
                        <i class="fas fa-plus"></i> Tambah Jurusan
                    </button>
                </div>
                <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-4 flex items-center text-slate-400"><i class="fas fa-search text-xs"></i></span>
                        <input type="text" id="jurusanSearchInput" placeholder="Cari jurusan..." class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs outline-none focus:border-primary transition-all">
                    </div>
                </div>
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                                    <th class="px-6 py-5 w-12">No</th>
                                    <th class="px-6 py-5">Kode</th>
                                    <th class="px-6 py-5">Nama Jurusan</th>
                                    <th class="px-6 py-5">Kajur</th>
                                    <th class="px-6 py-5 text-center">Jumlah Prodi</th>
                                    <th class="px-6 py-5 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="jurusanTableBody" class="divide-y divide-slate-100"></tbody>
                        </table>
                        <div id="jurusanNoData" class="hidden p-16 text-center">
                            <i class="fas fa-university text-4xl text-slate-200 mb-3 block"></i>
                            <p class="text-slate-400 text-sm font-medium italic">Tidak ada jurusan ditemukan.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ==================== KATEGORI ==================== -->
            <section id="kategoriTab" class="hidden space-y-6">
                <div>
                    <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Kategori Prestasi</h2>
                    <p class="text-slate-500 text-sm">Kelola kategori dan tingkat prestasi mahasiswa.</p>
                </div>
                <div class="flex gap-3">
                    <button onclick="openKategoriModal()" class="px-6 py-3 bg-emerald-500 text-white rounded-2xl text-sm font-bold hover:bg-emerald-600 transition-all flex items-center gap-2 shadow-lg shadow-emerald-100">
                        <i class="fas fa-plus"></i> Tambah Kategori
                    </button>
                    <button onclick="openTingkatModal()" class="px-6 py-3 bg-primary text-white rounded-2xl text-sm font-bold hover:bg-blue-900 transition-all flex items-center gap-2 shadow-lg shadow-blue-100">
                        <i class="fas fa-plus"></i> Tambah Tingkat
                    </button>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-slate-100">
                            <h3 class="text-sm font-black text-slate-700 uppercase tracking-widest">Kategori</h3>
                            <div class="relative mt-3">
                                <span class="absolute inset-y-0 left-3 flex items-center text-slate-400"><i class="fas fa-search text-xs"></i></span>
                                <input type="text" id="katSearchInput" placeholder="Cari..." class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs outline-none focus:border-primary transition-all">
                            </div>
                        </div>
                        <div id="kategoriList" class="divide-y divide-slate-100 max-h-96 overflow-y-auto"></div>
                        <div class="px-6 py-3 border-t border-slate-100">
                            <button onclick="openKategoriModal()" class="w-full py-2.5 border border-dashed border-slate-300 rounded-xl text-xs font-bold text-slate-400 hover:text-primary hover:border-primary transition-all flex items-center justify-center gap-2">
                                <i class="fas fa-plus"></i> Tambah Baru
                            </button>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-slate-100">
                            <h3 class="text-sm font-black text-slate-700 uppercase tracking-widest">Tingkat</h3>
                            <div class="relative mt-3">
                                <span class="absolute inset-y-0 left-3 flex items-center text-slate-400"><i class="fas fa-search text-xs"></i></span>
                                <input type="text" id="tingkatSearchInput" placeholder="Cari..." class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs outline-none focus:border-primary transition-all">
                            </div>
                        </div>
                        <div id="tingkatList" class="divide-y divide-slate-100 max-h-96 overflow-y-auto"></div>
                        <div class="px-6 py-3 border-t border-slate-100">
                            <button onclick="openTingkatModal()" class="w-full py-2.5 border border-dashed border-slate-300 rounded-xl text-xs font-bold text-slate-400 hover:text-primary hover:border-primary transition-all flex items-center justify-center gap-2">
                                <i class="fas fa-plus"></i> Tambah Baru
                            </button>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </main>
</div>

<!-- ==================== MODAL: MAHASISWA ==================== -->
<div id="modalMahasiswa" class="modal-overlay fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="modal-box bg-white rounded-[2rem] shadow-2xl w-full max-w-lg">
        <div class="flex items-center justify-between p-8 pb-0">
            <div>
                <h3 id="mhsModalTitle" class="text-xl font-black text-slate-800">Tambah Mahasiswa</h3>
                <p class="text-xs text-slate-400 font-medium mt-1">Isi data mahasiswa dengan lengkap dan benar.</p>
            </div>
            <button onclick="closeModal('modalMahasiswa')" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 hover:bg-slate-200 transition-all">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-8 space-y-4">
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">NIM</label>
                <input type="text" id="mhsNIM" class="form-input" placeholder="Contoh: E41251200">
            </div>
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Nama Lengkap</label>
                <input type="text" id="mhsNama" class="form-input" placeholder="Nama lengkap mahasiswa">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Jurusan</label>
                    <select id="mhsJurusan" class="form-input">
                        <option value="">Pilih Jurusan</option>
                        <option>Teknologi Informasi</option>
                        <option>Pertanian</option>
                        <option>Kesehatan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Angkatan</label>
                    <select id="mhsAngkatan" class="form-input">
                        <option>2025</option>
                        <option>2024</option>
                        <option>2023</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Status</label>
                <select id="mhsStatus" class="form-input">
                    <option>Aktif</option>
                    <option>Cuti</option>
                    <option>Lulus</option>
                </select>
            </div>
        </div>
        <div class="px-8 pb-8 flex gap-3">
            <button onclick="closeModal('modalMahasiswa')" class="flex-1 py-3 border border-slate-200 rounded-2xl text-sm font-bold text-slate-600 hover:bg-slate-50 transition-all">Batal</button>
            <button onclick="saveMahasiswa()" class="flex-1 py-3 bg-primary text-white rounded-2xl text-sm font-black hover:bg-blue-900 transition-all shadow-lg shadow-blue-100">Simpan Data</button>
        </div>
    </div>
</div>

<!-- ==================== MODAL: JURUSAN ==================== -->
<div id="modalJurusan" class="modal-overlay fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="modal-box bg-white rounded-[2rem] shadow-2xl w-full max-w-md">
        <div class="flex items-center justify-between p-8 pb-0">
            <div>
                <h3 id="jurusanModalTitle" class="text-xl font-black text-slate-800">Tambah Jurusan</h3>
                <p class="text-xs text-slate-400 font-medium mt-1">Data jurusan baru.</p>
            </div>
            <button onclick="closeModal('modalJurusan')" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 hover:bg-slate-200 transition-all">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-8 space-y-4">
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Kode Jurusan</label>
                <input type="text" id="jurusanKode" class="form-input" placeholder="Contoh: TI">
            </div>
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Nama Jurusan</label>
                <input type="text" id="jurusanNama" class="form-input" placeholder="Nama lengkap jurusan">
            </div>
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Kepala Jurusan</label>
                <input type="text" id="jurusanKajur" class="form-input" placeholder="Nama dosen Kajur">
            </div>
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Jumlah Program Studi</label>
                <input type="number" id="jurusanProdi" class="form-input" placeholder="0" min="0">
            </div>
        </div>
        <div class="px-8 pb-8 flex gap-3">
            <button onclick="closeModal('modalJurusan')" class="flex-1 py-3 border border-slate-200 rounded-2xl text-sm font-bold text-slate-600 hover:bg-slate-50 transition-all">Batal</button>
            <button onclick="saveJurusan()" class="flex-1 py-3 bg-primary text-white rounded-2xl text-sm font-black hover:bg-blue-900 transition-all shadow-lg shadow-blue-100">Simpan Data</button>
        </div>
    </div>
</div>

<!-- ==================== MODAL: TAMBAH / EDIT DATA PRESTASI ==================== -->
<div id="modalPrestasi" class="modal-overlay fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="modal-box bg-white rounded-[2rem] shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between p-8 pb-0">
            <div>
                <h3 id="prestasiModalTitle" class="text-xl font-black text-slate-800">Tambah Data Prestasi</h3>
                <p class="text-xs text-slate-400 font-medium mt-1">Isi data prestasi mahasiswa secara lengkap.</p>
            </div>
            <button onclick="closeModal('modalPrestasi')" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 hover:bg-slate-200 transition-all">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-8 space-y-5">
            <!-- Identitas Mahasiswa -->
            <div class="pb-4 border-b border-slate-100">
                <p class="text-[10px] font-black text-primary uppercase tracking-widest mb-3">Identitas Mahasiswa</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">NIM</label>
                        <input type="text" id="presNIM" class="form-input" placeholder="Contoh: E41251131">
                    </div>
                    <div>
                        <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Nama Mahasiswa</label>
                        <input type="text" id="presNama" class="form-input" placeholder="Nama lengkap mahasiswa">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Jurusan / Prodi</label>
                        <select id="presJurusan" class="form-input">
                            <option value="">Pilih Jurusan</option>
                            <option value="Teknologi Informasi">Teknologi Informasi</option>
                            <option value="Teknik">Teknik</option>
                            <option value="Pertanian">Pertanian</option>
                            <option value="Kesehatan">Kesehatan</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- Detail Prestasi -->
            <div class="pb-4 border-b border-slate-100">
                <p class="text-[10px] font-black text-primary uppercase tracking-widest mb-3">Detail Prestasi</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Nama Lomba / Kegiatan</label>
                        <input type="text" id="presLomba" class="form-input" placeholder="Contoh: Robotic International Challenge">
                    </div>
                    <div>
                        <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Prestasi / Peringkat</label>
                        <select id="presPrestasi" class="form-input">
                            <option value="">Pilih Prestasi</option>
                            <option value="Juara 1">Juara 1</option>
                            <option value="Juara 2">Juara 2</option>
                            <option value="Juara 3">Juara 3</option>
                            <option value="Finalis">Finalis</option>
                            <option value="Peserta">Peserta</option>
                            <option value="Pemenang">Pemenang</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Kategori</label>
                        <select id="presKategori" class="form-input">
                            <option value="">Pilih Kategori</option>
                            <option value="Akademik">Akademik</option>
                            <option value="Olahraga">Olahraga</option>
                            <option value="Sains">Sains</option>
                            <option value="Karya Ilmiah">Karya Ilmiah</option>
                            <option value="Wirausaha">Wirausaha</option>
                            <option value="Seni">Seni</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Tingkat</label>
                        <select id="presTingkat" class="form-input">
                            <option value="">Pilih Tingkat</option>
                            <option value="Internasional">Internasional</option>
                            <option value="Nasional">Nasional</option>
                            <option value="Provinsi">Provinsi</option>
                            <option value="Kabupaten">Kabupaten</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Tahun</label>
                        <select id="presTahun" class="form-input">
                            <option value="2026">2026</option>
                            <option value="2025">2025</option>
                            <option value="2024">2024</option>
                            <option value="2023">2023</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Tanggal Pelaksanaan</label>
                        <input type="date" id="presTanggal" class="form-input">
                    </div>
                    <div>
                        <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Lokasi</label>
                        <input type="text" id="presLokasi" class="form-input" placeholder="Contoh: Yogyakarta">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Penyelenggara</label>
                        <input type="text" id="presPenyelenggara" class="form-input" placeholder="Contoh: Universitas Gadjah Mada">
                    </div>
                </div>
            </div>
        </div>
        <div class="px-8 pb-8 flex gap-3">
            <button onclick="closeModal('modalPrestasi')" class="flex-1 py-3 border border-slate-200 rounded-2xl text-sm font-bold text-slate-600 hover:bg-slate-50 transition-all">Batal</button>
            <button onclick="savePrestasi()" class="flex-1 py-3 bg-cyan-500 text-white rounded-2xl text-sm font-black hover:bg-cyan-600 transition-all shadow-lg shadow-cyan-100">Simpan Data</button>
        </div>
    </div>
</div>

<!-- ==================== MODAL: KATEGORI ==================== -->
<div id="modalKategori" class="modal-overlay fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="modal-box bg-white rounded-[2rem] shadow-2xl w-full max-w-md">
        <div class="flex items-center justify-between p-8 pb-0">
            <div>
                <h3 id="kategoriModalTitle" class="text-xl font-black text-slate-800">Tambah Kategori</h3>
                <p class="text-xs text-slate-400 font-medium mt-1">Tambah kategori prestasi baru.</p>
            </div>
            <button onclick="closeModal('modalKategori')" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 hover:bg-slate-200 transition-all">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-8 space-y-4">
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Nama Kategori</label>
                <input type="text" id="kategoriNama" class="form-input" placeholder="Contoh: Akademik">
            </div>
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Ikon</label>
                <select id="kategoriIcon" class="form-input">
                    <option value="fas fa-graduation-cap">🎓 Akademik</option>
                    <option value="fas fa-trophy">🏆 Olahraga</option>
                    <option value="fas fa-flask">🔬 Sains</option>
                    <option value="fas fa-palette">🎨 Seni</option>
                    <option value="fas fa-hands-helping">🤝 Sosial</option>
                    <option value="fas fa-briefcase">💼 Wirausaha</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Warna Tema</label>
                <div class="flex gap-3 mt-1" id="colorPicker">
                    <button onclick="selectColor(this,'blue')" class="w-8 h-8 rounded-full bg-blue-500 ring-2 ring-offset-2 ring-transparent hover:ring-blue-400 transition-all" data-color="blue"></button>
                    <button onclick="selectColor(this,'emerald')" class="w-8 h-8 rounded-full bg-emerald-500 ring-2 ring-offset-2 ring-transparent hover:ring-emerald-400 transition-all" data-color="emerald"></button>
                    <button onclick="selectColor(this,'amber')" class="w-8 h-8 rounded-full bg-amber-500 ring-2 ring-offset-2 ring-transparent hover:ring-amber-400 transition-all" data-color="amber"></button>
                    <button onclick="selectColor(this,'purple')" class="w-8 h-8 rounded-full bg-purple-500 ring-2 ring-offset-2 ring-transparent hover:ring-purple-400 transition-all" data-color="purple"></button>
                    <button onclick="selectColor(this,'rose')" class="w-8 h-8 rounded-full bg-rose-500 ring-2 ring-offset-2 ring-transparent hover:ring-rose-400 transition-all" data-color="rose"></button>
                    <button onclick="selectColor(this,'orange')" class="w-8 h-8 rounded-full bg-orange-500 ring-2 ring-offset-2 ring-transparent hover:ring-orange-400 transition-all" data-color="orange"></button>
                </div>
                <input type="hidden" id="kategoriColor" value="blue">
            </div>
        </div>
        <div class="px-8 pb-8 flex gap-3">
            <button onclick="closeModal('modalKategori')" class="flex-1 py-3 border border-slate-200 rounded-2xl text-sm font-bold text-slate-600 hover:bg-slate-50 transition-all">Batal</button>
            <button onclick="saveKategori()" class="flex-1 py-3 bg-emerald-500 text-white rounded-2xl text-sm font-black hover:bg-emerald-600 transition-all shadow-lg shadow-emerald-100">Simpan</button>
        </div>
    </div>
</div>

<!-- ==================== MODAL: TINGKAT ==================== -->
<div id="modalTingkat" class="modal-overlay fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="modal-box bg-white rounded-[2rem] shadow-2xl w-full max-w-md">
        <div class="flex items-center justify-between p-8 pb-0">
            <div>
                <h3 id="tingkatModalTitle" class="text-xl font-black text-slate-800">Tambah Tingkat</h3>
                <p class="text-xs text-slate-400 font-medium mt-1">Tambah tingkat prestasi baru.</p>
            </div>
            <button onclick="closeModal('modalTingkat')" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 hover:bg-slate-200 transition-all">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-8 space-y-4">
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Nama Tingkat</label>
                <input type="text" id="tingkatNama" class="form-input" placeholder="Contoh: Internasional">
            </div>
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Ikon</label>
                <select id="tingkatIcon" class="form-input">
                    <option value="fas fa-map-marker-alt">📍 Kabupaten/Kota</option>
                    <option value="fas fa-globe-asia">🌏 Provinsi</option>
                    <option value="fas fa-flag">🏳 Nasional</option>
                    <option value="fas fa-globe">🌍 Internasional</option>
                    <option value="fas fa-building">🏢 Lokal/Kampus</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Poin Bobot</label>
                <input type="number" id="tingkatPoin" class="form-input" placeholder="Contoh: 100" min="0">
            </div>
        </div>
        <div class="px-8 pb-8 flex gap-3">
            <button onclick="closeModal('modalTingkat')" class="flex-1 py-3 border border-slate-200 rounded-2xl text-sm font-bold text-slate-600 hover:bg-slate-50 transition-all">Batal</button>
            <button onclick="saveTingkat()" class="flex-1 py-3 bg-primary text-white rounded-2xl text-sm font-black hover:bg-blue-900 transition-all shadow-lg shadow-blue-100">Simpan</button>
        </div>
    </div>
</div>

<!-- ==================== MODAL: DETAIL MAHASISWA ==================== -->
<div id="modalDetailMhs" class="modal-overlay fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="modal-box bg-white rounded-[2rem] shadow-2xl w-full max-w-lg">
        <div class="flex items-center justify-between p-8 pb-0">
            <h3 class="text-xl font-black text-slate-800">Detail Mahasiswa</h3>
            <button onclick="closeModal('modalDetailMhs')" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 hover:bg-slate-200 transition-all">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-8">
            <div class="flex items-center gap-6 mb-8">
                <div id="detailAvatar" class="w-20 h-20 rounded-2xl bg-primary flex items-center justify-center text-white text-3xl font-black overflow-hidden"></div>
                <div>
                    <h4 id="detailNama" class="text-xl font-black text-slate-800"></h4>
                    <p id="detailNIM" class="text-primary font-bold text-sm mt-1"></p>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="p-4 bg-slate-50 rounded-2xl"><p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Jurusan</p><p id="detailJurusan" class="text-xs font-extrabold text-slate-700 mt-1"></p></div>
                <div class="p-4 bg-slate-50 rounded-2xl"><p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Angkatan</p><p id="detailAngkatan" class="text-xs font-extrabold text-slate-700 mt-1"></p></div>
                <div class="p-4 bg-slate-50 rounded-2xl"><p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Status</p><p id="detailStatus" class="text-xs font-extrabold text-slate-700 mt-1"></p></div>
                <div class="p-4 bg-slate-50 rounded-2xl"><p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Total Prestasi</p><p id="detailPrestasi" class="text-xs font-extrabold text-slate-700 mt-1"></p></div>
            </div>
        </div>
        <div class="px-8 pb-8">
            <button onclick="closeModal('modalDetailMhs')" class="w-full py-3 bg-primary text-white rounded-2xl text-sm font-black hover:bg-blue-900 transition-all">Tutup</button>
        </div>
    </div>
</div>

<script>
// ===================== DATA STATE =====================
let mahasiswaData = [
    { nim: 'E41251131', nama: 'Ani Rizqi Z.S', jurusan: 'Teknologi Informasi', angkatan: '2025', status: 'Aktif', prestasi: 3 },
    { nim: 'E41251146', nama: 'Erix Agung W.', jurusan: 'Teknologi Informasi', angkatan: '2025', status: 'Aktif', prestasi: 2 },
    { nim: 'E41251122', nama: 'Fikriyah Imtyaz', jurusan: 'Teknologi Informasi', angkatan: '2025', status: 'Aktif', prestasi: 1 },
    { nim: 'E41242089', nama: 'Budi Santoso', jurusan: 'Pertanian', angkatan: '2024', status: 'Aktif', prestasi: 0 },
    { nim: 'E41232045', nama: 'Siti Rahayu', jurusan: 'Kesehatan', angkatan: '2023', status: 'Cuti', prestasi: 1 },
];

let jurusanData = [
    { kode: 'TI', nama: 'Teknologi Informasi', kajur: 'Dr. Ahmad Fauzi, M.T.', prodi: 5 },
    { kode: 'PP', nama: 'Pertanian', kajur: 'Dr. Sri Wahyuni, M.P.', prodi: 4 },
    { kode: 'KES', nama: 'Kesehatan', kajur: 'Dr. Rina Hastuti, M.Kes.', prodi: 3 },
];

// FIX: prestasiData sekarang menjadi array data yang dirender secara dinamis
let prestasiData = [
    { id: 1, nim: 'E41251131', nama: 'Ani Rizqi Ziarotus S.', jurusan: 'Teknologi Informasi', prestasi: 'Juara 1', lomba: 'Robotic International Challenge', kategori: 'Sains', tingkat: 'Internasional', tahun: '2024' },
    { id: 2, nim: 'E41251146', nama: 'Fikriyah Imtiyaz', jurusan: 'Teknologi Informasi', prestasi: 'Finalis', lomba: 'PIMNAS Ke-37', kategori: 'Karya Ilmiah', tingkat: 'Nasional', tahun: '2024' },
    { id: 3, nim: 'E41252200', nama: 'Erix Agung Wibowo', jurusan: 'Teknik', prestasi: 'Juara 3', lomba: 'PORPROV Jawa Timur VIII', kategori: 'Olahraga', tingkat: 'Provinsi', tahun: '2023' },
];

let kategoriData = [
    { id: 1, nama: 'Akademik', icon: 'fas fa-graduation-cap', color: 'blue', count: 5 },
    { id: 2, nama: 'Olahraga', icon: 'fas fa-trophy', color: 'amber', count: 10 },
    { id: 3, nama: 'Sains', icon: 'fas fa-flask', color: 'emerald', count: 8 },
    { id: 4, nama: 'Seni', icon: 'fas fa-palette', color: 'purple', count: 15 },
    { id: 5, nama: 'Sosial', icon: 'fas fa-hands-helping', color: 'rose', count: 3 },
];

let tingkatData = [
    { id: 1, nama: 'Kabupaten', icon: 'fas fa-map-marker-alt', poin: 10, count: 5 },
    { id: 2, nama: 'Provinsi', icon: 'fas fa-globe-asia', poin: 25, count: 10 },
    { id: 3, nama: 'Nasional', icon: 'fas fa-flag', poin: 50, count: 8 },
    { id: 4, nama: 'Internasional', icon: 'fas fa-globe', poin: 100, count: 15 },
    { id: 5, nama: 'Lokal', icon: 'fas fa-building', poin: 5, count: 3 },
];

let editingMhsIndex = -1;
let editingJurusanIndex = -1;
let editingKategoriId = null;
let editingTingkatId = null;
let editingPrestasiId = null;
let confirmCallback = null;
let selectedColor = 'blue';

const colorPalette = {
    blue:    { bg: 'bg-blue-50',    text: 'text-blue-600',    ring: 'bg-blue-500' },
    emerald: { bg: 'bg-emerald-50', text: 'text-emerald-600', ring: 'bg-emerald-500' },
    amber:   { bg: 'bg-amber-50',   text: 'text-amber-600',   ring: 'bg-amber-500' },
    purple:  { bg: 'bg-purple-50',  text: 'text-purple-600',  ring: 'bg-purple-500' },
    rose:    { bg: 'bg-rose-50',    text: 'text-rose-600',    ring: 'bg-rose-500' },
    orange:  { bg: 'bg-orange-50',  text: 'text-orange-600',  ring: 'bg-orange-500' },
};

// Warna badge untuk tingkat & kategori
function getBadgeClass(value) {
    const map = {
        'Internasional': 'bg-purple-50 text-purple-600 border-purple-100',
        'Nasional':      'bg-emerald-50 text-emerald-600 border-emerald-100',
        'Provinsi':      'bg-slate-50 text-slate-600 border-slate-100',
        'Kabupaten':     'bg-orange-50 text-orange-600 border-orange-100',
        'Sains':         'bg-blue-50 text-blue-600 border-blue-100',
        'Akademik':      'bg-indigo-50 text-indigo-600 border-indigo-100',
        'Olahraga':      'bg-orange-50 text-orange-600 border-orange-100',
        'Karya Ilmiah':  'bg-amber-50 text-amber-600 border-amber-100',
        'Wirausaha':     'bg-cyan-50 text-cyan-600 border-cyan-100',
        'Seni':          'bg-pink-50 text-pink-600 border-pink-100',
    };
    return map[value] || 'bg-slate-50 text-slate-600 border-slate-100';
}

function getPrestasiColor(p) {
    if (p === 'Juara 1') return 'text-indigo-700';
    if (p === 'Juara 2') return 'text-emerald-700';
    if (p === 'Juara 3') return 'text-orange-700';
    if (p === 'Finalis') return 'text-emerald-700';
    return 'text-slate-600';
}
function getPrestasiDot(p) {
    if (p === 'Juara 1') return 'bg-indigo-500';
    if (p === 'Juara 2') return 'bg-emerald-500';
    if (p === 'Juara 3') return 'bg-orange-500';
    if (p === 'Finalis') return 'bg-emerald-500';
    return 'bg-slate-400';
}

// ===================== NAVIGATION =====================
const navLinks = document.querySelectorAll('.nav-link');
const sectionIds = ['dashboardTab','verifikasiTab','dataprestasiTab','datamahasiswaTab','datajurusanTab','kategoriTab'];
const menuNames = ['Dashboard','Verifikasi','Data Prestasi','Data Mahasiswa','Data Jurusan','Kategori'];

function switchTab(menuName) {
    localStorage.setItem('simpresma_active_tab', menuName);
    navLinks.forEach(l => {
        const span = l.querySelector('span');
        if (span && span.innerText.trim() === menuName) {
            l.classList.add('active');
            l.classList.remove('opacity-70');
            l.classList.add('opacity-100');
        } else {
            l.classList.remove('active');
            l.classList.remove('opacity-100');
            l.classList.add('opacity-70');
        }
    });
    sectionIds.forEach(id => {
        const el = document.getElementById(id);
        if (el) el.classList.add('hidden');
    });
    const idx = menuNames.indexOf(menuName);
    if (idx >= 0) {
        const el = document.getElementById(sectionIds[idx]);
        if (el) el.classList.remove('hidden');
    }
    document.getElementById('pageTitle').innerText = menuName;
    if (menuName === 'Dashboard') initDashboardCharts();
    if (menuName === 'Data Prestasi') renderPrestasiTable();
    if (menuName === 'Data Mahasiswa') renderMahasiswaTable();
    if (menuName === 'Data Jurusan') renderJurusanTable();
    if (menuName === 'Kategori') { renderKategoriList(); renderTingkatList(); }
}

navLinks.forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        const span = this.querySelector('span');
        if (span) switchTab(span.innerText.trim());
    });
});

window.addEventListener('DOMContentLoaded', () => {
    const last = localStorage.getItem('simpresma_active_tab') || 'Dashboard';
    setTimeout(() => switchTab(last), 10);
});

// ===================== CHARTS =====================
let trendChart = null, jurusanChart = null;

function initDashboardCharts() {
    const ctxTrend = document.getElementById('trendChart');
    if (ctxTrend) {
        if (trendChart) trendChart.destroy();
        trendChart = new Chart(ctxTrend, {
            type: 'line',
            data: {
                labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
                datasets: [{ label: 'Jumlah Prestasi', data: [45,52,48,70,65,90,85,110,105,130,120,150], borderColor: '#1e3a8a', backgroundColor: 'rgba(30,58,138,0.05)', borderWidth: 4, fill: true, tension: 0.4, pointRadius: 0, pointHoverRadius: 6 }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { grid: { borderDash: [5,5] }, ticks: { font: { weight: 'bold' } } }, x: { grid: { display: false }, ticks: { font: { weight: 'bold' } } } } }
        });
    }
    const ctxJurusan = document.getElementById('jurusanChart');
    if (ctxJurusan) {
        if (jurusanChart) jurusanChart.destroy();
        jurusanChart = new Chart(ctxJurusan, {
            type: 'polarArea',
            data: {
                labels: ['TI','Teknik','Kesehatan','Bisnis','Bahasa'],
                datasets: [{ data: [450,320,280,210,150], backgroundColor: ['#1e3a8a','#3b82f6','#60a5fa','#93c5fd','#bfdbfe'], borderWidth: 0 }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { r: { display: false } } }
        });
    }
}

// ===================== TOAST =====================
function showToast(message, type = 'success') {
    const container = document.getElementById('toast-container');
    const icons = { success: 'fa-check-circle', error: 'fa-times-circle', info: 'fa-info-circle' };
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    toast.innerHTML = `<i class="fas ${icons[type]}"></i><span>${message}</span>`;
    container.appendChild(toast);
    setTimeout(() => {
        toast.classList.add('removing');
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

// ===================== CONFIRM DIALOG =====================
function showConfirm(title, msg, color, callback) {
    confirmCallback = callback;
    document.getElementById('confirmTitle').innerText = title;
    document.getElementById('confirmMsg').innerText = msg;
    const icon = document.getElementById('confirmIcon');
    const btn = document.getElementById('confirmOkBtn');
    if (color === 'red') {
        icon.className = 'w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl bg-rose-100 text-rose-500';
        icon.innerHTML = '<i class="fas fa-trash-alt"></i>';
        btn.className = 'flex-1 py-3 rounded-2xl text-sm font-black text-white transition-all bg-rose-500 hover:bg-rose-600';
    } else {
        icon.className = 'w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl bg-amber-100 text-amber-500';
        icon.innerHTML = '<i class="fas fa-exclamation-triangle"></i>';
        btn.className = 'flex-1 py-3 rounded-2xl text-sm font-black text-white transition-all bg-amber-500 hover:bg-amber-600';
    }
    document.getElementById('confirmDialog').classList.remove('hidden');
}

function cancelConfirm() { document.getElementById('confirmDialog').classList.add('hidden'); }

document.getElementById('confirmOkBtn').addEventListener('click', () => {
    document.getElementById('confirmDialog').classList.add('hidden');
    if (confirmCallback) confirmCallback();
});

// ===================== MODAL HELPERS =====================
function openModal(id) { document.getElementById(id).classList.remove('hidden'); }
function closeModal(id) { document.getElementById(id).classList.add('hidden'); }

document.querySelectorAll('.modal-overlay').forEach(overlay => {
    overlay.addEventListener('click', function(e) {
        if (e.target === this) closeModal(this.id);
    });
});

// ===================== DATA PRESTASI =====================
function renderPrestasiTable() {
    const search    = (document.getElementById('searchFilter')?.value || '').toLowerCase();
    const jurusan   = document.getElementById('jurusanFilterPrestasi')?.value || '';
    const kategori  = document.getElementById('kategoriFilter')?.value || '';
    const tingkat   = document.getElementById('tingkatFilter')?.value || '';
    const tahun     = document.getElementById('tahunFilter')?.value || '';

    // FIX: filter kini membandingkan nilai field data secara langsung (bukan atribut HTML)
    const filtered = prestasiData.filter(p => {
        const matchSearch   = !search   || p.nim.toLowerCase().includes(search) || p.nama.toLowerCase().includes(search) || p.lomba.toLowerCase().includes(search);
        const matchJurusan  = !jurusan  || p.jurusan === jurusan;
        const matchKategori = !kategori || p.kategori === kategori;
        const matchTingkat  = !tingkat  || p.tingkat === tingkat;
        const matchTahun    = !tahun    || p.tahun === tahun;
        return matchSearch && matchJurusan && matchKategori && matchTingkat && matchTahun;
    });

    const tbody = document.getElementById('prestasiTableBody');
    const noData = document.getElementById('noData');
    const table = document.getElementById('tablePrestasi');

    if (filtered.length === 0) {
        tbody.innerHTML = '';
        noData.classList.remove('hidden');
        table.classList.add('hidden');
    } else {
        noData.classList.add('hidden');
        table.classList.remove('hidden');
        tbody.innerHTML = filtered.map(p => {
            const tingkatLabel = p.tingkat.length > 5 ? p.tingkat.substring(0,5) : p.tingkat;
            return `
            <tr class="data-row group">
                <td class="px-6 py-5"><span class="text-xs font-mono font-bold text-slate-400 bg-slate-100 px-2 py-1 rounded">${p.nim}</span></td>
                <td class="px-6 py-5">
                    <div class="text-xs font-extrabold text-slate-800">${p.nama}</div>
                    <div class="text-[10px] text-slate-400">${p.jurusan}</div>
                </td>
                <td class="px-6 py-5">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full ${getPrestasiDot(p.prestasi)}"></span>
                        <span class="text-xs font-bold ${getPrestasiColor(p.prestasi)}">${p.prestasi}</span>
                    </div>
                </td>
                <td class="px-6 py-5"><span class="text-xs text-slate-600 font-medium italic">${p.lomba}</span></td>
                <td class="px-6 py-5 text-center"><span class="px-2.5 py-1 rounded-lg text-[10px] font-bold border uppercase ${getBadgeClass(p.kategori)}">${p.kategori}</span></td>
                <td class="px-6 py-5 text-center"><span class="px-2.5 py-1 rounded-lg text-[10px] font-bold border uppercase ${getBadgeClass(p.tingkat)}">${tingkatLabel}</span></td>
                <td class="px-6 py-5 text-center"><span class="text-xs font-bold text-slate-500">${p.tahun}</span></td>
                <td class="px-6 py-5 text-center">
                    <div class="flex items-center justify-center gap-2 opacity-50 group-hover:opacity-100 transition-all">
                        <button onclick="editPrestasi(${p.id})" class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 hover:bg-emerald-600 hover:text-white transition-all flex items-center justify-center" title="Edit"><i class="fas fa-edit text-[10px]"></i></button>
                        <button onclick="deletePrestasi(${p.id})" class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 hover:bg-rose-500 hover:text-white transition-all flex items-center justify-center" title="Hapus"><i class="fas fa-trash text-[10px]"></i></button>
                    </div>
                </td>
            </tr>`;
        }).join('');
    }
    document.getElementById('visibleCount').innerText = filtered.length;
}

function openPrestasiModal(id = null) {
    editingPrestasiId = id;
    document.getElementById('prestasiModalTitle').innerText = id ? 'Edit Data Prestasi' : 'Tambah Data Prestasi';
    if (id) {
        const p = prestasiData.find(x => x.id === id);
        document.getElementById('presNIM').value          = p.nim;
        document.getElementById('presNama').value         = p.nama;
        document.getElementById('presJurusan').value      = p.jurusan;
        document.getElementById('presLomba').value        = p.lomba;
        document.getElementById('presPrestasi').value     = p.prestasi;
        document.getElementById('presKategori').value     = p.kategori;
        document.getElementById('presTingkat').value      = p.tingkat;
        document.getElementById('presTahun').value        = p.tahun;
        document.getElementById('presTanggal').value      = p.tanggal || '';
        document.getElementById('presLokasi').value       = p.lokasi || '';
        document.getElementById('presPenyelenggara').value= p.penyelenggara || '';
    } else {
        ['presNIM','presNama','presLomba','presTanggal','presLokasi','presPenyelenggara'].forEach(id => {
            document.getElementById(id).value = '';
        });
        document.getElementById('presJurusan').value  = '';
        document.getElementById('presPrestasi').value = '';
        document.getElementById('presKategori').value = '';
        document.getElementById('presTingkat').value  = '';
        document.getElementById('presTahun').value    = '2025';
    }
    openModal('modalPrestasi');
    setTimeout(() => document.getElementById('presNIM').focus(), 100);
}

function savePrestasi() {
    const nim           = document.getElementById('presNIM').value.trim();
    const nama          = document.getElementById('presNama').value.trim();
    const jurusan       = document.getElementById('presJurusan').value;
    const lomba         = document.getElementById('presLomba').value.trim();
    const prestasi      = document.getElementById('presPrestasi').value;
    const kategori      = document.getElementById('presKategori').value;
    const tingkat       = document.getElementById('presTingkat').value;
    const tahun         = document.getElementById('presTahun').value;
    const tanggal       = document.getElementById('presTanggal').value;
    const lokasi        = document.getElementById('presLokasi').value.trim();
    const penyelenggara = document.getElementById('presPenyelenggara').value.trim();

    if (!nim || !nama || !jurusan || !lomba || !prestasi || !kategori || !tingkat) {
        showToast('Harap isi semua field yang wajib diisi!', 'error');
        return;
    }

    if (editingPrestasiId) {
        const p = prestasiData.find(x => x.id === editingPrestasiId);
        Object.assign(p, { nim, nama, jurusan, lomba, prestasi, kategori, tingkat, tahun, tanggal, lokasi, penyelenggara });
        showToast(`Data prestasi "${nama}" berhasil diperbarui.`, 'success');
    } else {
        prestasiData.push({ id: Date.now(), nim, nama, jurusan, lomba, prestasi, kategori, tingkat, tahun, tanggal, lokasi, penyelenggara });
        showToast(`Data prestasi "${nama}" berhasil ditambahkan.`, 'success');
    }
    closeModal('modalPrestasi');
    renderPrestasiTable();
}

function editPrestasi(id) { openPrestasiModal(id); }

function deletePrestasi(id) {
    const p = prestasiData.find(x => x.id === id);
    showConfirm('Hapus Data Prestasi', `Yakin ingin menghapus prestasi "${p.lomba}" milik ${p.nama}?`, 'red', () => {
        prestasiData = prestasiData.filter(x => x.id !== id);
        showToast(`Data prestasi berhasil dihapus.`, 'error');
        renderPrestasiTable();
    });
}

function resetFilters() {
    document.getElementById('searchFilter').value          = '';
    document.getElementById('jurusanFilterPrestasi').value = '';
    document.getElementById('kategoriFilter').value        = '';
    document.getElementById('tingkatFilter').value         = '';
    document.getElementById('tahunFilter').value           = '';
    renderPrestasiTable();
}

// Event listener filter prestasi
['searchFilter','jurusanFilterPrestasi','kategoriFilter','tingkatFilter','tahunFilter'].forEach(id => {
    const el = document.getElementById(id);
    if (el) {
        el.addEventListener('input',  renderPrestasiTable);
        el.addEventListener('change', renderPrestasiTable);
    }
});

// ===================== MAHASISWA =====================
function renderMahasiswaTable() {
    const search   = (document.getElementById('mhsSearchInput')?.value || '').toLowerCase();
    const jurusan  = document.getElementById('mhsJurusanFilter')?.value || '';
    const angkatan = document.getElementById('mhsAngkatanFilter')?.value || '';
    const status   = document.getElementById('mhsStatusFilter')?.value || '';

    const filtered = mahasiswaData.filter(m =>
        (!search   || m.nim.toLowerCase().includes(search) || m.nama.toLowerCase().includes(search))
        && (!jurusan  || m.jurusan === jurusan)
        && (!angkatan || m.angkatan === angkatan)
        && (!status   || m.status === status)
    );

    const tbody  = document.getElementById('mhsTableBody');
    const noData = document.getElementById('mhsNoData');

    if (filtered.length === 0) {
        tbody.innerHTML = '';
        noData.classList.remove('hidden');
    } else {
        noData.classList.add('hidden');
        tbody.innerHTML = filtered.map(m => {
            const realIdx = mahasiswaData.indexOf(m);
            const statusColor = m.status === 'Aktif'
                ? 'bg-emerald-50 text-emerald-600 border-emerald-100'
                : m.status === 'Cuti'
                ? 'bg-amber-50 text-amber-600 border-amber-100'
                : 'bg-slate-50 text-slate-500 border-slate-100';
            return `
            <tr class="data-row group">
                <td class="px-6 py-4"><span class="text-xs font-mono font-bold text-slate-400 bg-slate-100 px-2 py-1 rounded">${m.nim}</span></td>
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center text-white text-xs font-black">${m.nama.charAt(0)}</div>
                        <span class="text-xs font-extrabold text-slate-800">${m.nama}</span>
                    </div>
                </td>
                <td class="px-6 py-4"><span class="text-xs text-slate-600 font-medium">${m.jurusan}</span></td>
                <td class="px-6 py-4 text-center"><span class="text-xs font-bold text-slate-500">${m.angkatan}</span></td>
                <td class="px-6 py-4 text-center"><span class="px-2.5 py-1 rounded-lg text-[10px] font-bold border uppercase ${statusColor}">${m.status}</span></td>
                <td class="px-6 py-4 text-center">
                    <div class="flex items-center justify-center gap-2 opacity-50 group-hover:opacity-100 transition-all">
                        <button onclick="viewMahasiswaDetail(${realIdx})" class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 hover:bg-indigo-600 hover:text-white transition-all flex items-center justify-center" title="Lihat Detail"><i class="fas fa-eye text-[10px]"></i></button>
                        <button onclick="editMahasiswa(${realIdx})" class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 hover:bg-emerald-600 hover:text-white transition-all flex items-center justify-center" title="Edit"><i class="fas fa-edit text-[10px]"></i></button>
                        <button onclick="deleteMahasiswa(${realIdx})" class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 hover:bg-rose-500 hover:text-white transition-all flex items-center justify-center" title="Hapus"><i class="fas fa-trash text-[10px]"></i></button>
                    </div>
                </td>
            </tr>`;
        }).join('');
    }
    document.getElementById('mhsCount').innerText = filtered.length;
}

function openMahasiswaModal(editIdx = -1) {
    editingMhsIndex = editIdx;
    document.getElementById('mhsModalTitle').innerText = editIdx >= 0 ? 'Edit Data Mahasiswa' : 'Tambah Mahasiswa Baru';
    if (editIdx >= 0) {
        const m = mahasiswaData[editIdx];
        document.getElementById('mhsNIM').value      = m.nim;
        document.getElementById('mhsNama').value     = m.nama;
        document.getElementById('mhsJurusan').value  = m.jurusan;
        document.getElementById('mhsAngkatan').value = m.angkatan;
        document.getElementById('mhsStatus').value   = m.status;
    } else {
        document.getElementById('mhsNIM').value      = '';
        document.getElementById('mhsNama').value     = '';
        document.getElementById('mhsJurusan').value  = '';
        document.getElementById('mhsAngkatan').value = '2025';
        document.getElementById('mhsStatus').value   = 'Aktif';
    }
    openModal('modalMahasiswa');
    setTimeout(() => document.getElementById('mhsNIM').focus(), 100);
}

function saveMahasiswa() {
    const nim     = document.getElementById('mhsNIM').value.trim();
    const nama    = document.getElementById('mhsNama').value.trim();
    const jurusan = document.getElementById('mhsJurusan').value;
    const angkatan= document.getElementById('mhsAngkatan').value;
    const status  = document.getElementById('mhsStatus').value;
    if (!nim || !nama || !jurusan) { showToast('Harap isi semua field yang diperlukan!','error'); return; }
    if (editingMhsIndex >= 0) {
        mahasiswaData[editingMhsIndex] = { ...mahasiswaData[editingMhsIndex], nim, nama, jurusan, angkatan, status };
        showToast(`Data ${nama} berhasil diperbarui.`,'success');
    } else {
        mahasiswaData.push({ nim, nama, jurusan, angkatan, status, prestasi: 0 });
        showToast(`Mahasiswa ${nama} berhasil ditambahkan.`,'success');
    }
    closeModal('modalMahasiswa');
    renderMahasiswaTable();
}

function editMahasiswa(idx)   { openMahasiswaModal(idx); }

function deleteMahasiswa(idx) {
    const m = mahasiswaData[idx];
    showConfirm('Hapus Mahasiswa', `Yakin ingin menghapus data "${m.nama}"? Tindakan ini tidak dapat dibatalkan.`, 'red', () => {
        mahasiswaData.splice(idx, 1);
        showToast(`Data ${m.nama} berhasil dihapus.`,'error');
        renderMahasiswaTable();
    });
}

function viewMahasiswaDetail(idx) {
    const m = mahasiswaData[idx];
    document.getElementById('detailAvatar').innerText   = m.nama.charAt(0);
    document.getElementById('detailNama').innerText     = m.nama;
    document.getElementById('detailNIM').innerText      = m.nim;
    document.getElementById('detailJurusan').innerText  = m.jurusan;
    document.getElementById('detailAngkatan').innerText = m.angkatan;
    document.getElementById('detailStatus').innerText   = m.status;
    document.getElementById('detailPrestasi').innerText = `${m.prestasi} Prestasi`;
    openModal('modalDetailMhs');
}

['mhsSearchInput','mhsJurusanFilter','mhsAngkatanFilter','mhsStatusFilter'].forEach(id => {
    document.getElementById(id)?.addEventListener('input',  renderMahasiswaTable);
    document.getElementById(id)?.addEventListener('change', renderMahasiswaTable);
});

// ===================== JURUSAN =====================
function renderJurusanTable() {
    const search   = (document.getElementById('jurusanSearchInput')?.value || '').toLowerCase();
    const filtered = jurusanData.filter(j => j.nama.toLowerCase().includes(search) || j.kode.toLowerCase().includes(search));
    const tbody    = document.getElementById('jurusanTableBody');
    const noData   = document.getElementById('jurusanNoData');

    if (filtered.length === 0) {
        tbody.innerHTML = '';
        noData.classList.remove('hidden');
    } else {
        noData.classList.add('hidden');
        tbody.innerHTML = filtered.map((j, i) => {
            const realIdx = jurusanData.indexOf(j);
            return `
            <tr class="data-row group">
                <td class="px-6 py-4"><span class="text-xs font-bold text-slate-400">${i + 1}</span></td>
                <td class="px-6 py-4"><span class="px-3 py-1 bg-primary text-white text-xs font-black rounded-lg">${j.kode}</span></td>
                <td class="px-6 py-4"><span class="text-xs font-extrabold text-slate-800">${j.nama}</span></td>
                <td class="px-6 py-4"><span class="text-xs text-slate-600">${j.kajur}</span></td>
                <td class="px-6 py-4 text-center"><span class="px-2.5 py-1 bg-blue-50 text-blue-600 rounded-lg text-[10px] font-bold border border-blue-100">${j.prodi} Prodi</span></td>
                <td class="px-6 py-4 text-center">
                    <div class="flex items-center justify-center gap-2 opacity-50 group-hover:opacity-100 transition-all">
                        <button onclick="editJurusan(${realIdx})" class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 hover:bg-emerald-600 hover:text-white transition-all flex items-center justify-center" title="Edit"><i class="fas fa-edit text-[10px]"></i></button>
                        <button onclick="deleteJurusan(${realIdx})" class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 hover:bg-rose-500 hover:text-white transition-all flex items-center justify-center" title="Hapus"><i class="fas fa-trash text-[10px]"></i></button>
                    </div>
                </td>
            </tr>`;
        }).join('');
    }
}

function openJurusanModal(editIdx = -1) {
    editingJurusanIndex = editIdx;
    document.getElementById('jurusanModalTitle').innerText = editIdx >= 0 ? 'Edit Data Jurusan' : 'Tambah Jurusan Baru';
    if (editIdx >= 0) {
        const j = jurusanData[editIdx];
        document.getElementById('jurusanKode').value  = j.kode;
        document.getElementById('jurusanNama').value  = j.nama;
        document.getElementById('jurusanKajur').value = j.kajur;
        document.getElementById('jurusanProdi').value = j.prodi;
    } else {
        document.getElementById('jurusanKode').value  = '';
        document.getElementById('jurusanNama').value  = '';
        document.getElementById('jurusanKajur').value = '';
        document.getElementById('jurusanProdi').value = '';
    }
    openModal('modalJurusan');
}

function saveJurusan() {
    const kode  = document.getElementById('jurusanKode').value.trim().toUpperCase();
    const nama  = document.getElementById('jurusanNama').value.trim();
    const kajur = document.getElementById('jurusanKajur').value.trim();
    const prodi = parseInt(document.getElementById('jurusanProdi').value) || 0;
    if (!kode || !nama || !kajur) { showToast('Harap isi semua field!','error'); return; }
    if (editingJurusanIndex >= 0) {
        jurusanData[editingJurusanIndex] = { kode, nama, kajur, prodi };
        showToast(`Jurusan ${nama} berhasil diperbarui.`,'success');
    } else {
        jurusanData.push({ kode, nama, kajur, prodi });
        showToast(`Jurusan ${nama} berhasil ditambahkan.`,'success');
    }
    closeModal('modalJurusan');
    renderJurusanTable();
}

function editJurusan(idx)   { openJurusanModal(idx); }

function deleteJurusan(idx) {
    const j = jurusanData[idx];
    showConfirm('Hapus Jurusan', `Yakin ingin menghapus jurusan "${j.nama}"?`, 'red', () => {
        jurusanData.splice(idx, 1);
        showToast(`Jurusan ${j.nama} berhasil dihapus.`,'error');
        renderJurusanTable();
    });
}

document.getElementById('jurusanSearchInput')?.addEventListener('input', renderJurusanTable);

// ===================== KATEGORI =====================
function renderKategoriList() {
    const search   = (document.getElementById('katSearchInput')?.value || '').toLowerCase();
    const filtered = kategoriData.filter(k => k.nama.toLowerCase().includes(search));
    const list     = document.getElementById('kategoriList');
    const c        = colorPalette;
    list.innerHTML = filtered.map(k => {
        const col = c[k.color] || c.blue;
        return `
        <div class="kategori-item flex items-center gap-4 px-6 py-4 cursor-pointer">
            <div class="w-10 h-10 rounded-xl ${col.bg} ${col.text} flex items-center justify-center text-lg">
                <i class="${k.icon}"></i>
            </div>
            <div class="flex-1">
                <span class="text-sm font-bold text-slate-800">${k.nama}</span>
                <p class="text-[10px] text-slate-400 font-medium">${k.count} prestasi terdaftar</p>
            </div>
            <span class="${col.ring} text-white text-[10px] font-black px-3 py-1 rounded-full">${k.count} ›</span>
            <div class="flex gap-1 ml-2">
                <button onclick="editKategori(${k.id})" class="w-7 h-7 rounded-lg hover:bg-emerald-50 text-emerald-500 flex items-center justify-center transition-all" title="Edit"><i class="fas fa-edit text-xs"></i></button>
                <button onclick="deleteKategori(${k.id})" class="w-7 h-7 rounded-lg hover:bg-rose-50 text-rose-400 flex items-center justify-center transition-all" title="Hapus"><i class="fas fa-trash text-xs"></i></button>
            </div>
        </div>`;
    }).join('') || '<div class="p-8 text-center text-slate-400 text-sm">Tidak ada kategori ditemukan.</div>';
}

function renderTingkatList() {
    const search   = (document.getElementById('tingkatSearchInput')?.value || '').toLowerCase();
    const filtered = tingkatData.filter(t => t.nama.toLowerCase().includes(search));
    const list     = document.getElementById('tingkatList');
    const tingkatColors = { 1:'blue', 2:'emerald', 3:'rose', 4:'purple', 5:'slate' };
    const tingkatBg     = { blue:'bg-blue-50 text-blue-600', emerald:'bg-emerald-50 text-emerald-600', rose:'bg-rose-50 text-rose-600', purple:'bg-purple-50 text-purple-600', slate:'bg-slate-100 text-slate-500' };
    const tingkatBadge  = { blue:'bg-blue-500', emerald:'bg-emerald-500', rose:'bg-rose-500', purple:'bg-purple-500', slate:'bg-slate-400' };

    list.innerHTML = filtered.map(t => {
        const colKey = tingkatColors[t.id] || 'blue';
        const bg     = tingkatBg[colKey]    || tingkatBg.blue;
        const badge  = tingkatBadge[colKey] || tingkatBadge.blue;
        return `
        <div class="kategori-item flex items-center gap-4 px-6 py-4 cursor-pointer">
            <div class="w-10 h-10 rounded-xl ${bg} flex items-center justify-center text-lg">
                <i class="${t.icon}"></i>
            </div>
            <div class="flex-1">
                <span class="text-sm font-bold text-slate-800">${t.nama}</span>
                <p class="text-[10px] text-slate-400 font-medium">${t.poin} poin bobot · ${t.count} prestasi</p>
            </div>
            <span class="${badge} text-white text-[10px] font-black px-3 py-1 rounded-full">${t.count} ›</span>
            <div class="flex gap-1 ml-2">
                <button onclick="editTingkat(${t.id})" class="w-7 h-7 rounded-lg hover:bg-emerald-50 text-emerald-500 flex items-center justify-center transition-all" title="Edit"><i class="fas fa-edit text-xs"></i></button>
                <button onclick="deleteTingkat(${t.id})" class="w-7 h-7 rounded-lg hover:bg-rose-50 text-rose-400 flex items-center justify-center transition-all" title="Hapus"><i class="fas fa-trash text-xs"></i></button>
            </div>
        </div>`;
    }).join('') || '<div class="p-8 text-center text-slate-400 text-sm">Tidak ada tingkat ditemukan.</div>';
}

function openKategoriModal(id = null) {
    editingKategoriId = id;
    selectedColor = 'blue';
    document.getElementById('kategoriModalTitle').innerText = id ? 'Edit Kategori' : 'Tambah Kategori Baru';
    if (id) {
        const k = kategoriData.find(x => x.id === id);
        document.getElementById('kategoriNama').value = k.nama;
        document.getElementById('kategoriIcon').value = k.icon;
        selectedColor = k.color;
    } else {
        document.getElementById('kategoriNama').value = '';
        document.getElementById('kategoriIcon').value = 'fas fa-graduation-cap';
    }
    document.getElementById('kategoriColor').value = selectedColor;
    document.querySelectorAll('#colorPicker button').forEach(btn => {
        btn.style.outline = '';
        if (btn.dataset.color === selectedColor) btn.style.outline = '2px solid #1e3a8a';
    });
    openModal('modalKategori');
}

function selectColor(btn, color) {
    selectedColor = color;
    document.getElementById('kategoriColor').value = color;
    document.querySelectorAll('#colorPicker button').forEach(b => b.style.outline = '');
    btn.style.outline = '2px solid #1e3a8a';
}

function saveKategori() {
    const nama  = document.getElementById('kategoriNama').value.trim();
    const icon  = document.getElementById('kategoriIcon').value;
    const color = document.getElementById('kategoriColor').value;
    if (!nama) { showToast('Nama kategori tidak boleh kosong!','error'); return; }
    if (editingKategoriId) {
        const k = kategoriData.find(x => x.id === editingKategoriId);
        k.nama = nama; k.icon = icon; k.color = color;
        showToast(`Kategori "${nama}" berhasil diperbarui.`,'success');
    } else {
        kategoriData.push({ id: Date.now(), nama, icon, color, count: 0 });
        showToast(`Kategori "${nama}" berhasil ditambahkan.`,'success');
    }
    closeModal('modalKategori');
    renderKategoriList();
}

function editKategori(id)   { openKategoriModal(id); }

function deleteKategori(id) {
    const k = kategoriData.find(x => x.id === id);
    showConfirm('Hapus Kategori', `Yakin ingin menghapus kategori "${k.nama}"?`, 'red', () => {
        kategoriData = kategoriData.filter(x => x.id !== id);
        showToast(`Kategori "${k.nama}" dihapus.`,'error');
        renderKategoriList();
    });
}

document.getElementById('katSearchInput')?.addEventListener('input', renderKategoriList);

// ===================== TINGKAT =====================
function openTingkatModal(id = null) {
    editingTingkatId = id;
    document.getElementById('tingkatModalTitle').innerText = id ? 'Edit Tingkat' : 'Tambah Tingkat Baru';
    if (id) {
        const t = tingkatData.find(x => x.id === id);
        document.getElementById('tingkatNama').value = t.nama;
        document.getElementById('tingkatIcon').value = t.icon;
        document.getElementById('tingkatPoin').value = t.poin;
    } else {
        document.getElementById('tingkatNama').value = '';
        document.getElementById('tingkatIcon').value = 'fas fa-map-marker-alt';
        document.getElementById('tingkatPoin').value = '';
    }
    openModal('modalTingkat');
}

function saveTingkat() {
    const nama = document.getElementById('tingkatNama').value.trim();
    const icon = document.getElementById('tingkatIcon').value;
    const poin = parseInt(document.getElementById('tingkatPoin').value) || 0;
    if (!nama) { showToast('Nama tingkat tidak boleh kosong!','error'); return; }
    if (editingTingkatId) {
        const t = tingkatData.find(x => x.id === editingTingkatId);
        t.nama = nama; t.icon = icon; t.poin = poin;
        showToast(`Tingkat "${nama}" berhasil diperbarui.`,'success');
    } else {
        tingkatData.push({ id: Date.now(), nama, icon, poin, count: 0 });
        showToast(`Tingkat "${nama}" berhasil ditambahkan.`,'success');
    }
    closeModal('modalTingkat');
    renderTingkatList();
}

function editTingkat(id)   { openTingkatModal(id); }

function deleteTingkat(id) {
    const t = tingkatData.find(x => x.id === id);
    showConfirm('Hapus Tingkat', `Yakin ingin menghapus tingkat "${t.nama}"?`, 'red', () => {
        tingkatData = tingkatData.filter(x => x.id !== id);
        showToast(`Tingkat "${t.nama}" dihapus.`,'error');
        renderTingkatList();
    });
}

document.getElementById('tingkatSearchInput')?.addEventListener('input', renderTingkatList);

// ===================== VERIFIKASI ACTIONS =====================
function verifikasiAction(action, nama) {
    const msgs = {
        setujui: { msg: `Prestasi "${nama}" berhasil disetujui.`, type: 'success' },
        tolak:   { msg: `Prestasi "${nama}" telah ditolak.`,      type: 'error' },
        revisi:  { msg: `Prestasi "${nama}" dikirim untuk revisi.`, type: 'info' },
    };
    showToast(msgs[action].msg, msgs[action].type);
}
</script>
</body>
</html>