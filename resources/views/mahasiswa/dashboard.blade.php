<?php
class Prestasi
{
    public $nama;
    public $tanggal;
    public $tingkat;
    public $status;

    public function __construct($nama, $tanggal, $tingkat, $status)
    {
        $this->nama = $nama;
        $this->tanggal = $tanggal;
        $this->tingkat = $tingkat;
        $this->status = $status;
    }

    public function getStatusLabel()
    {
        switch (strtolower($this->status)) {
            case 'pending':
                return 'bg-amber-50 text-amber-600 border-amber-200/50';
            case 'disetujui':
                return 'bg-green-50 text-green-600 border-green-200/50';
            case 'ditolak':
                return 'bg-red-50 text-red-600 border-red-200/50';
            default:
                return 'bg-slate-50 text-slate-600 border-slate-200/50';
        }
    }
}

$daftarPrestasi = [
    new Prestasi("Hackathon Polije 2026", "12 April 2026", "Nasional", "Pending"),
    new Prestasi("Lomba Karya Tulis Ilmiah", "10 April 2026", "Provinsi", "Disetujui"),
    new Prestasi("Olimpiade Matematika", "05 April 2026", "Internasional", "Ditolak")
];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPRESMA POLIJE | Dashboard Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');

        :root {
            --primary: #1e3a8a;
            --primary-light: #3b82f6;
            --bg-main: #f8fafc;
            --sidebar-width: 280px;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-main);
            color: #1e293b;
        }

        .custom-scroll::-webkit-scrollbar { width: 6px; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }

        .bg-primary { background-color: var(--primary); }
        .text-primary { color: var(--primary); }
        .border-primary { border-color: var(--primary); }

        .sidebar {
            background-color: #1e3a8a;
            transition: all 0.3s ease;
        }

        .nav-link {
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link.active {
            background: white;
            color: #1e3a8a;
            border-radius: 30px 0 0 30px;
            font-weight: 700;
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            right: 0;
            top: -30px;
            width: 30px;
            height: 30px;
            background: transparent;
            border-radius: 50%;
            box-shadow: 15px 15px 0 white;
        }

        .nav-link.active::before {
            content: '';
            position: absolute;
            right: 0;
            bottom: -30px;
            width: 30px;
            height: 30px;
            background: transparent;
            border-radius: 50%;
            box-shadow: 15px -15px 0 white;
        }

        .profile-card {
            background: #ffffff;
            border-radius: 32px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            margin-top: 100px;
            padding: 100px 40px 40px 40px;
            position: relative;
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .profile-img-container {
            width: 180px;
            height: 180px;
            background: #e2e8f0;
            border-radius: 50%;
            position: absolute;
            top: -90px;
            left: 50%;
            transform: translateX(-50%);
            border: 8px solid white;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            align-items: flex-end;
            justify-content: center;
        }

        .achievement-card {
            background: white;
            border-radius: 32px;
            height: 100%;
            display: flex;
            flex-direction: column;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
            border: 1px solid #f1f5f9;
        }

        .podium-container {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border-radius: 24px;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 24px;
        }

        .scroll-area {
            max-height: calc(100vh - 450px);
            overflow-y: auto;
            padding-right: 10px;
        }

        .scroll-area::-webkit-scrollbar { width: 4px; }
        .scroll-area::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }

        .badge-rank {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .badge-gold { background: #fef3c7; color: #92400e; }
        .badge-silver { background: #f1f5f9; color: #475569; }
        .badge-bronze { background: #ffedd5; color: #9a3412; }

        /* ===================== UX ADDITIONS ===================== */

        /* Smooth section transitions */
        .section-transition {
            animation: fadeSlideIn 0.25s ease forwards;
        }

        @keyframes fadeSlideIn {
            from { opacity: 0; transform: translateY(8px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Toast notification */
        #toast-container {
            position: fixed;
            bottom: 28px;
            right: 28px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 10px;
            pointer-events: none;
        }

        .toast {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            border-radius: 16px;
            background: white;
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
            font-size: 13px;
            font-weight: 600;
            color: #1e293b;
            border: 1px solid #f1f5f9;
            pointer-events: all;
            animation: toastIn 0.3s cubic-bezier(0.34,1.56,0.64,1) forwards;
            min-width: 260px;
            max-width: 360px;
        }

        .toast.removing {
            animation: toastOut 0.25s ease forwards;
        }

        .toast-icon {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            flex-shrink: 0;
        }

        .toast-success .toast-icon { background: #dcfce7; color: #16a34a; }
        .toast-error   .toast-icon { background: #fee2e2; color: #dc2626; }
        .toast-info    .toast-icon { background: #dbeafe; color: #2563eb; }
        .toast-warning .toast-icon { background: #fef3c7; color: #d97706; }

        @keyframes toastIn {
            from { opacity: 0; transform: translateX(30px) scale(0.95); }
            to   { opacity: 1; transform: translateX(0) scale(1); }
        }

        @keyframes toastOut {
            from { opacity: 1; transform: translateX(0) scale(1); }
            to   { opacity: 0; transform: translateX(30px) scale(0.95); }
        }

        /* Inline form validation */
        .field-error {
            font-size: 11px;
            color: #dc2626;
            font-weight: 600;
            margin-top: 4px;
            margin-left: 4px;
            display: none;
        }

        .field-error.visible { display: block; animation: fadeSlideIn 0.2s ease; }

        input.input-error, select.input-error, textarea.input-error {
            border-color: #fca5a5 !important;
            background: #fff5f5 !important;
        }

        input.input-ok, select.input-ok, textarea.input-ok {
            border-color: #86efac !important;
        }

        /* Button loading spinner */
        .btn-spinner {
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255,255,255,0.4);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
            display: none;
        }

        @keyframes spin { to { transform: rotate(360deg); } }

        /* Drag & drop upload zone */
        .upload-zone.dragover {
            border-color: #3b82f6 !important;
            background: #eff6ff !important;
        }

        .upload-zone.dragover * { pointer-events: none; }

        /* Nav keyboard focus */
        .nav-link:focus-visible {
            outline: 2px solid rgba(255,255,255,0.6);
            outline-offset: -3px;
            border-radius: 12px;
        }

        /* Confirmation modal */
        #confirm-modal {
            position: fixed;
            inset: 0;
            z-index: 9998;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(15,23,42,0.4);
            backdrop-filter: blur(4px);
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s ease;
        }

        #confirm-modal.open {
            opacity: 1;
            pointer-events: all;
        }

        #confirm-modal .modal-box {
            background: white;
            border-radius: 28px;
            padding: 32px;
            width: 360px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
            transform: scale(0.95);
            transition: transform 0.2s cubic-bezier(0.34,1.56,0.64,1);
        }

        #confirm-modal.open .modal-box { transform: scale(1); }

        /* Avatar selected ring */
        .avatar-btn-selected {
            border-color: #1e3a8a !important;
            box-shadow: 0 0 0 3px rgba(30,58,138,0.2);
        }

        /* Smooth scroll for history table */
        #subtab-history { scroll-behavior: smooth; }

        /* Password strength bar */
        #pw-strength-bar {
            height: 4px;
            border-radius: 4px;
            transition: width 0.3s ease, background 0.3s ease;
            width: 0%;
        }
    </style>
</head>

<body class="flex min-h-screen">

    <!-- TOAST CONTAINER -->
    <div id="toast-container" aria-live="polite" aria-atomic="true"></div>

    <!-- CONFIRM MODAL -->
    <div id="confirm-modal" role="dialog" aria-modal="true" aria-labelledby="confirm-title">
        <div class="modal-box">
            <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center mb-4">
                <i class="fas fa-rotate-left text-amber-500 text-lg"></i>
            </div>
            <h3 id="confirm-title" class="text-lg font-black text-slate-800 mb-2">Reset Formulir?</h3>
            <p class="text-sm text-slate-500 mb-6">Semua data yang sudah diisi akan dihapus. Tindakan ini tidak dapat dibatalkan.</p>
            <div class="flex gap-3">
                <button id="confirm-cancel" class="flex-1 py-3 bg-slate-100 text-slate-600 rounded-2xl font-bold text-sm hover:bg-slate-200 transition-all">Batal</button>
                <button id="confirm-ok"     class="flex-1 py-3 bg-red-500 text-white rounded-2xl font-bold text-sm hover:bg-red-600 transition-all">Ya, Reset</button>
            </div>
        </div>
    </div>

    <!-- SIDEBAR -->
    <aside class="sidebar w-72 flex flex-col py-8 pl-6 text-white shrink-0">
        <div class="p-8">
            <div class="flex items-center -ml-5 -mt-8">
                <div class="p-2 rounded-xl -ml-1">
                    <img src="asset/img/logo.png" class="w-10 h-10 object-contain" alt="Polije Logo">
                </div>
                <div class="ml-1">
                    <h1 class="font-extrabold text-sm tracking-tight leading-none text-white">SIMPRESMA</h1>
                    <p class="text-[10px] text-blue-200 font-medium tracking-widest uppercase mt-1">Politeknik Negeri Jember</p>
                </div>
            </div>
        </div>

        <nav class="flex-1 space-y-2" role="navigation" aria-label="Menu utama">
            <a href="javascript:void(0)" onclick="showSection('dashboard')"  tabindex="0" role="menuitem" aria-current="page" class="nav-link active flex items-center space-x-4 py-4 px-6">
                <i class="fas fa-th-large" aria-hidden="true"></i>
                <span>Dashboard</span>
            </a>
            <a href="javascript:void(0)" onclick="showSection('pengajuan')" tabindex="0" role="menuitem" class="nav-link flex items-center space-x-4 py-4 px-6 opacity-70 hover:opacity-100">
                <i class="fas fa-paper-plane" aria-hidden="true"></i>
                <span>Pengajuan</span>
            </a>
            <a href="javascript:void(0)" onclick="showSection('pengaturan')" tabindex="0" role="menuitem" class="nav-link flex items-center space-x-4 py-4 px-6 opacity-70 hover:opacity-100">
                <i class="fas fa-cog" aria-hidden="true"></i>
                <span>Pengaturan</span>
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
    <main class="ml-[5px] flex-1 p-10 h-screen flex flex-col gap-8 min-h-0">

        <!-- HEADER -->
        <header class="flex justify-between items-center -mt-3">
            <div>
                <h1 id="header-title" class="text-2xl font-extrabold text-slate-800 tracking-tight">Selamat Datang, <span class="text-blue-700">Ani!</span></h1>
                <p id="header-subtitle" class="text-sm text-slate-500">Pantau terus perkembangan prestasimu hari ini.</p>
            </div>

            <div class="flex items-center gap-2">
                <button class="relative p-2 bg-white border border-slate-200 rounded-xl text-slate-600 hover:bg-slate-50 transition-colors" aria-label="Notifikasi" title="Notifikasi">
                    <i class="fas fa-bell" aria-hidden="true"></i>
                    <span class="absolute top-3 right-2 w-2 h-2 bg-red-500 border-2 border-white rounded-full"></span>
                </button>
                <div class="h-10 w-10 bg-blue-100 rounded-xl flex items-center justify-center text-blue-700 font-bold border border-blue-200" title="Ani Rizqi Ziarotus S.">AZ</div>
            </div>
        </header>

        <!-- DASHBOARD SECTION -->
        <section id="dashboard-section" class="flex gap-10 flex-1 overflow-hidden">
            <div class="w-[45%] flex flex-col">
                <div class="profile-card flex flex-col items-center">
                    <div class="profile-img-container">
                        <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=Ani" class="w-full h-full object-cover" alt="Foto profil Ani">
                    </div>
                    <div class="text-center w-full">
                        <h2 class="text-2xl font-black text-slate-800 tracking-wide uppercase">Ani Rizqi Ziarotus S.</h2>
                        <div class="flex items-center justify-center gap-2 mt-2">
                            <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-xs font-bold border border-blue-100 uppercase tracking-widest">E41251131</span>
                        </div>
                        <div class="grid grid-cols-2 gap-4 mt-8">
                            <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                <span class="text-[10px] text-slate-400 font-bold uppercase block mb-1">Jurusan</span>
                                <span class="text-sm font-bold text-slate-700">Teknologi Informasi</span>
                            </div>
                            <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                <span class="text-[10px] text-slate-400 font-bold uppercase block mb-1">Prodi</span>
                                <span class="text-sm font-bold text-slate-700">Teknik Informatika</span>
                            </div>
                        </div>
                        <div class="mt-8 pt-8 border-t border-slate-100 flex items-center justify-center gap-3">
                            <img src="asset/img/logo.png" alt="Logo Polije" class="w-8">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-[0.3em]">Politeknik Negeri Jember</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex-1 flex flex-col -mt-5">
                <div class="achievement-card p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-slate-800 flex items-center gap-3">
                            <i class="fas fa-star text-yellow-400" aria-hidden="true"></i>
                            Riwayat Prestasi Terkini
                        </h3>
                        <a href="#" onclick="showSection('pengajuan'); switchFormTab('history'); return false;" class="text-blue-600 text-sm font-semibold hover:underline focus:outline-none focus:underline">Lihat Semua</a>
                    </div>
                    <div class="podium-container">
                        <svg viewBox="0 0 200 120" class="w-full max-w-[150px]" role="img" aria-label="Ilustrasi podium juara">
                            <rect x="75" y="40" width="50" height="60" fill="#e2e8f0" rx="4"/>
                            <rect x="25" y="60" width="50" height="40" fill="#cbd5e1" rx="4"/>
                            <rect x="125" y="70" width="50" height="30" fill="#94a3b8" rx="4"/>
                            <text x="94" y="75" font-weight="800" font-size="20" fill="#1e3a8a">1</text>
                            <text x="44" y="85" font-weight="800" font-size="16" fill="#475569">2</text>
                            <text x="144" y="90" font-weight="800" font-size="14" fill="#1e293b">3</text>
                            <path d="M92 20 L108 20 L104 35 L96 35 Z" fill="#fbbf24"/>
                            <circle cx="100" cy="15" r="8" fill="#fbbf24"/>
                        </svg>
                    </div>
                    <div class="scroll-area pr-2">
                        <div class="group relative flex gap-4 p-4 rounded-2xl hover:bg-blue-50 border border-transparent hover:border-blue-100 transition-all mb-3">
                            <div class="flex-shrink-0 w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center text-amber-500">
                                <i class="fas fa-award text-2xl" aria-hidden="true"></i>
                            </div>
                            <div>
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="badge-rank badge-gold">Juara 1</span>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">Internasional</span>
                                </div>
                                <h4 class="font-bold text-slate-800 text-sm leading-snug">Robotics and Automation Competition</h4>
                                <p class="text-xs text-slate-500 mt-1">Shanghai Jiao Tong University • Shanghai, China (2026)</p>
                            </div>
                        </div>
                        <div class="group relative flex gap-4 p-4 rounded-2xl hover:bg-blue-50 border border-transparent hover:border-blue-100 transition-all mb-3">
                            <div class="flex-shrink-0 w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center text-slate-500">
                                <i class="fas fa-medal text-2xl" aria-hidden="true"></i>
                            </div>
                            <div>
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="badge-rank badge-bronze">Juara 3</span>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">Internal</span>
                                </div>
                                <h4 class="font-bold text-slate-800 text-sm leading-snug">Student Dance Fest 2026: Feel the Beat</h4>
                                <p class="text-xs text-slate-500 mt-1">Politeknik Negeri Jember • Jember, Indonesia (2026)</p>
                            </div>
                        </div>
                        <div class="group relative flex gap-4 p-4 rounded-2xl hover:bg-blue-50 border border-transparent hover:border-blue-100 transition-all">
                            <div class="flex-shrink-0 w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center text-orange-400">
                                <i class="fas fa-certificate text-2xl" aria-hidden="true"></i>
                            </div>
                            <div>
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="badge-rank badge-silver">Harapan 2</span>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">Internal</span>
                                </div>
                                <h4 class="font-bold text-slate-800 text-sm leading-snug">Pekan Seni Mahasiswa (Lukis Realist)</h4>
                                <p class="text-xs text-slate-500 mt-1">Politeknik Negeri Jember • Jember, Indonesia (2026)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- PENGAJUAN SECTION -->
        <section id="pengajuan-section" class="hidden flex-1 flex flex-col min-h-0">
            <div class="flex gap-4 mb-6 bg-slate-100 p-1 rounded-2xl self-start shrink-0" role="tablist" aria-label="Tab pengajuan">
                <button onclick="switchFormTab('form')" id="tab-form-btn" role="tab" aria-selected="true" aria-controls="subtab-form"
                    class="px-6 py-2.5 rounded-xl font-bold text-sm transition-all bg-white text-blue-700 shadow-sm">
                    <i class="fas fa-plus-circle mr-2" aria-hidden="true"></i>Tambah Pengajuan
                </button>
                <button onclick="switchFormTab('history')" id="tab-history-btn" role="tab" aria-selected="false" aria-controls="subtab-history"
                    class="px-6 py-2.5 rounded-xl font-bold text-sm transition-all text-slate-500 hover:bg-white/50">
                    <i class="fas fa-history mr-2" aria-hidden="true"></i>Riwayat Pengajuan
                </button>
            </div>

            <!-- FORM TAB -->
            <div id="subtab-form" role="tabpanel" class="flex-1 overflow-y-auto pr-4 pb-10 custom-scroll">
                <form id="pengajuan-form" action="proses_simpan.php" method="POST" enctype="multipart/form-data"
                      class="space-y-8 bg-white p-8 md:p-10 rounded-[40px] border border-slate-200 shadow-sm"
                      novalidate>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label for="nama_kompetisi" class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Nama Kompetisi</label>
                            <input type="text" id="nama_kompetisi" name="nama_kompetisi" required
                                placeholder="Contoh: PKM-KC Nasional 2026"
                                class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:ring-4 focus:ring-blue-500/5 outline-none font-medium transition-colors"
                                aria-describedby="err-nama">
                            <p class="field-error" id="err-nama">Nama kompetisi wajib diisi.</p>
                        </div>
                        <div class="space-y-2">
                            <label for="penyelenggara" class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Penyelenggara</label>
                            <input type="text" id="penyelenggara" name="penyelenggara" required
                                placeholder="Contoh: KEMENDIKBUDRISTEK"
                                class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:ring-4 focus:ring-blue-500/5 outline-none font-medium transition-colors"
                                aria-describedby="err-penyelenggara">
                            <p class="field-error" id="err-penyelenggara">Penyelenggara wajib diisi.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="space-y-2">
                            <label for="kategori" class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Kategori</label>
                            <select id="kategori" name="kategori" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold transition-colors">
                                <option>Akademik</option>
                                <option>Seni</option>
                                <option>Olahraga</option>
                                <option>Teknologi</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label for="tingkat" class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Tingkat</label>
                            <select id="tingkat" name="tingkat" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold transition-colors">
                                <option>Internasional</option>
                                <option>Nasional</option>
                                <option>Provinsi</option>
                                <option>Kabupaten/Kota</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label for="capaian" class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Capaian</label>
                            <select id="capaian" name="capaian" class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold transition-colors">
                                <option>Juara 1</option>
                                <option>Juara 2</option>
                                <option>Juara 3</option>
                                <option>Harapan</option>
                                <option>Finalis</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label for="tanggal" class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Tanggal Pelaksanaan</label>
                            <input type="date" id="tanggal" name="tanggal" required
                                class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-bold transition-colors"
                                aria-describedby="err-tanggal">
                            <p class="field-error" id="err-tanggal">Tanggal wajib diisi.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label for="dosen" class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Dosen Pembimbing</label>
                            <input type="text" id="dosen" name="dosen" placeholder="Masukkan nama dosen lengkap..."
                                class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium transition-colors">
                        </div>
                        <div class="space-y-2">
                            <label for="lokasi" class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Lokasi (Kota)</label>
                            <input type="text" id="lokasi" name="lokasi" placeholder="Misal: Surabaya, Indonesia"
                                class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm font-medium transition-colors">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Upload Sertifikat -->
                        <div id="zone-cert"
                            class="upload-zone relative p-8 bg-slate-50 border-2 border-dashed border-slate-200 rounded-[30px] text-center hover:border-blue-400 hover:bg-blue-50/30 transition-all group"
                            role="button" tabindex="0" aria-label="Upload file sertifikat PDF">
                            <input type="file" name="file_sertifikat[]" id="file-cert"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                accept=".pdf" multiple
                                onchange="updateFileName(this, 'label-cert')"
                                aria-label="Pilih file sertifikat">
                            <div id="label-cert">
                                <i class="fas fa-file-pdf text-4xl text-slate-300 mb-3 group-hover:text-blue-500" aria-hidden="true"></i>
                                <p class="text-[10px] font-black uppercase text-slate-500 tracking-widest">Sertifikat (PDF - Bisa pilih banyak)</p>
                                <span class="mt-4 inline-block px-6 py-2 bg-white border border-slate-200 rounded-xl text-xs font-bold shadow-sm">Pilih File</span>
                            </div>
                        </div>

                        <!-- Upload Foto -->
                        <div id="zone-photo"
                            class="upload-zone relative p-8 bg-slate-50 border-2 border-dashed border-slate-200 rounded-[30px] text-center hover:border-blue-400 hover:bg-blue-50/30 transition-all group"
                            role="button" tabindex="0" aria-label="Upload foto dokumentasi">
                            <input type="file" name="file_foto[]" id="file-photo"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                accept="image/*" multiple
                                onchange="updateFileName(this, 'label-photo')"
                                aria-label="Pilih foto dokumentasi">
                            <div id="label-photo">
                                <i class="fas fa-image text-4xl text-slate-300 mb-3 group-hover:text-blue-500" aria-hidden="true"></i>
                                <p class="text-[10px] font-black uppercase text-slate-500 tracking-widest">Foto Dokumentasi (Bisa pilih banyak)</p>
                                <span class="mt-4 inline-block px-6 py-2 bg-white border border-slate-200 rounded-xl text-xs font-bold shadow-sm">Pilih Foto</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row gap-4 pt-6 border-t border-slate-100">
                        <button type="submit" id="submit-btn"
                            class="flex-1 py-4 bg-blue-700 text-white rounded-2xl font-bold shadow-lg shadow-blue-200 hover:bg-blue-800 hover:-translate-y-1 transition-all flex items-center justify-center gap-2 disabled:opacity-60 disabled:cursor-not-allowed disabled:hover:translate-y-0">
                            <div class="btn-spinner" id="submit-spinner" aria-hidden="true"></div>
                            <i class="fas fa-paper-plane" id="submit-icon" aria-hidden="true"></i>
                            <span id="submit-label">Kirim Pengajuan Prestasi</span>
                        </button>
                        <button type="button" onclick="confirmReset()"
                            class="px-10 py-4 bg-slate-100 text-slate-500 rounded-2xl font-bold hover:bg-slate-200 transition-all">
                            Reset
                        </button>
                    </div>
                </form>
            </div>

            <!-- HISTORY TAB -->
            <div id="subtab-history" role="tabpanel" class="hidden flex-1 overflow-y-auto custom-scroll">
                <div class="bg-white rounded-[40px] border border-slate-200 overflow-hidden shadow-sm">
                    <table class="w-full text-left" aria-label="Riwayat pengajuan prestasi">
                        <thead class="bg-slate-50 border-b border-slate-100">
                            <tr>
                                <th scope="col" class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Kompetisi</th>
                                <th scope="col" class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Tingkat</th>
                                <th scope="col" class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                                <th scope="col" class="px-10 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            <?php foreach ($daftarPrestasi as $p): ?>
                            <tr class="hover:bg-slate-50 transition-colors group">
                                <td class="px-8 py-6">
                                    <div class="font-bold text-slate-700"><?= htmlspecialchars($p->nama); ?></div>
                                    <div class="text-[10px] text-slate-400">Diajukan pada: <?= htmlspecialchars($p->tanggal); ?></div>
                                </td>
                                <td class="px-6 py-6 text-center">
                                    <span class="text-[13px] font-bold text-slate-600"><?= htmlspecialchars($p->tingkat); ?></span>
                                </td>
                                <td class="px-6 py-6 text-center">
                                    <span class="inline-block px-4 py-1.5 <?= $p->getStatusLabel(); ?> text-[10px] font-extrabold uppercase tracking-[0.15em] rounded-full border">
                                        <?= htmlspecialchars($p->status); ?>
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <button class="text-blue-600 hover:text-blue-800 text-sm font-bold opacity-0 group-hover:opacity-100 transition-opacity focus:opacity-100"
                                        onclick="showToast('info', 'Fitur detail sedang dalam pengembangan.', 'Info')"
                                        aria-label="Lihat detail <?= htmlspecialchars($p->nama); ?>">
                                        <i class="fas fa-eye mr-1" aria-hidden="true"></i> Detail
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- PENGATURAN SECTION -->
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

                        <form id="profil-form" action="proses_update_profil.php" method="POST" class="space-y-6" novalidate>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label for="email" class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Alamat Email</label>
                                    <div class="relative flex items-center">
                                        <i class="fas fa-envelope absolute left-5 text-slate-300" aria-hidden="true"></i>
                                        <input type="email" id="email" name="email" value="ani.rizqi@student.polije.ac.id" required
                                            class="w-full pl-12 pr-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:ring-4 focus:ring-blue-500/5 outline-none font-bold text-slate-700 transition-colors"
                                            aria-describedby="err-email">
                                    </div>
                                    <p class="field-error" id="err-email">Format email tidak valid.</p>
                                </div>
                                <div class="space-y-2">
                                    <label for="no_hp" class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Nomor WhatsApp</label>
                                    <div class="relative flex items-center">
                                        <i class="fab fa-whatsapp absolute left-5 text-slate-300" aria-hidden="true"></i>
                                        <input type="text" id="no_hp" name="no_hp" value="081234567890"
                                            class="w-full pl-12 pr-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:ring-4 focus:ring-blue-500/5 outline-none font-bold text-slate-700 transition-colors">
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label for="alamat" class="text-[11px] font-black text-slate-400 uppercase tracking-widest ml-1">Alamat Domisili</label>
                                <textarea id="alamat" name="alamat" rows="3"
                                    class="w-full px-6 py-4 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:ring-4 focus:ring-blue-500/5 outline-none font-medium text-slate-700 transition-colors">Jl. Mastrip No. 164, Jember, Jawa Timur</textarea>
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
                                        <!-- Password strength indicator -->
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
    </main>

    <!-- AVATAR MODAL -->
    <div id="avatar-modal" class="hidden fixed inset-0 z-[99] flex items-center justify-center bg-slate-900/40 backdrop-blur-sm p-4"
         role="dialog" aria-modal="true" aria-labelledby="avatar-modal-title">
        <div class="bg-white rounded-[40px] w-full max-w-md overflow-hidden shadow-2xl">
            <div class="p-8 border-b border-slate-100 flex justify-between items-center">
                <h3 id="avatar-modal-title" class="font-black text-slate-800 uppercase tracking-widest text-sm">Pilih Template Foto</h3>
                <button onclick="toggleAvatarModal()" class="text-slate-400 hover:text-slate-600 transition-colors" aria-label="Tutup modal">
                    <i class="fas fa-times" aria-hidden="true"></i>
                </button>
            </div>
            <div class="p-8 grid grid-cols-3 gap-4">
                <?php
                $avatarSeeds = ['Felix', 'Ani', 'Aneka', 'Budi', 'Sari', 'Doni'];
                foreach ($avatarSeeds as $seed):
                    $url = "https://api.dicebear.com/7.x/avataaars/svg?seed=$seed";
                ?>
                <button onclick="selectAvatar('<?= $url ?>')"
                    class="avatar-btn group relative aspect-square rounded-3xl overflow-hidden bg-slate-50 border-2 border-transparent hover:border-blue-500 transition-all focus:outline-none focus:border-blue-500"
                    aria-label="Pilih avatar <?= $seed ?>">
                    <img src="<?= $url ?>" class="w-full h-full p-2" alt="Avatar <?= $seed ?>">
                </button>
                <?php endforeach; ?>
            </div>
            <input type="hidden" name="selected_avatar_url" id="selected-avatar-input" value="">
        </div>
    </div>

    <script>
    /* ===================== SECTION NAVIGATION ===================== */
    function showSection(sectionId) {
        const titleEl = document.getElementById('header-title');
        const subEl   = document.getElementById('header-subtitle');

        const headers = {
            dashboard:   { title: 'Selamat Datang, <span class="text-blue-700">Ani!</span>', sub: 'Pantau terus perkembangan prestasimu hari ini.' },
            pengajuan:   { title: 'Pengajuan <span class="text-blue-700">Prestasi</span>',   sub: 'Ajukan prestasi akademik atau non-akademik terbaru Anda.' },
            pengaturan:  { title: 'Pengaturan <span class="text-blue-700">Profil</span>',    sub: 'Kelola informasi diri dan keamanan akun sistem Anda.' },
        };

        if (headers[sectionId]) {
            titleEl.innerHTML = headers[sectionId].title;
            subEl.textContent  = headers[sectionId].sub;
        }

        document.querySelectorAll('.nav-link').forEach(link => {
            const isActive = link.getAttribute('onclick').includes(sectionId);
            link.classList.toggle('active',   isActive);
            link.classList.toggle('opacity-100', isActive);
            link.classList.toggle('opacity-70',  !isActive);
            link.setAttribute('aria-current', isActive ? 'page' : 'false');
        });

        ['dashboard','pengajuan','pengaturan'].forEach(s => {
            const el = document.getElementById(s + '-section');
            if (!el) return;
            el.classList.add('hidden');
            el.classList.remove('flex','flex-col','flex-row','gap-10','section-transition');
        });

        const activeEl = document.getElementById(sectionId + '-section');
        if (activeEl) {
            activeEl.classList.remove('hidden');
            activeEl.classList.add('flex', 'section-transition');
            if (sectionId === 'dashboard') {
                activeEl.classList.add('flex-row', 'gap-10');
            } else {
                activeEl.classList.add('flex-col');
            }
        }
    }

    /* ===================== FORM TABS ===================== */
    function switchFormTab(tabName) {
        const formTab    = document.getElementById('subtab-form');
        const historyTab = document.getElementById('subtab-history');
        const formBtn    = document.getElementById('tab-form-btn');
        const historyBtn = document.getElementById('tab-history-btn');

        if (tabName === 'form') {
            formTab.classList.remove('hidden');
            historyTab.classList.add('hidden');
            formBtn.classList.add('bg-white','text-blue-700','shadow-sm');
            formBtn.classList.remove('text-slate-500');
            historyBtn.classList.remove('bg-white','text-blue-700','shadow-sm');
            historyBtn.classList.add('text-slate-500');
            formBtn.setAttribute('aria-selected','true');
            historyBtn.setAttribute('aria-selected','false');
        } else {
            formTab.classList.add('hidden');
            historyTab.classList.remove('hidden');
            historyBtn.classList.add('bg-white','text-blue-700','shadow-sm');
            historyBtn.classList.remove('text-slate-500');
            formBtn.classList.remove('bg-white','text-blue-700','shadow-sm');
            formBtn.classList.add('text-slate-500');
            historyBtn.setAttribute('aria-selected','true');
            formBtn.setAttribute('aria-selected','false');
        }
    }

    /* ===================== TOAST SYSTEM ===================== */
    const toastIcons = { success: 'fa-check', error: 'fa-times', info: 'fa-info', warning: 'fa-exclamation' };

    function showToast(type, message, title) {
        const container = document.getElementById('toast-container');
        const toast = document.createElement('div');
        toast.className = `toast toast-${type}`;
        toast.setAttribute('role','alert');
        toast.innerHTML = `
            <div class="toast-icon"><i class="fas ${toastIcons[type] || 'fa-info'}"></i></div>
            <div class="flex-1">
                ${title ? `<div style="font-size:11px;font-weight:800;text-transform:uppercase;letter-spacing:.08em;opacity:.6;margin-bottom:2px;">${title}</div>` : ''}
                <div style="font-size:13px;font-weight:600;line-height:1.4;">${message}</div>
            </div>
            <button onclick="dismissToast(this.closest('.toast'))" style="opacity:.4;font-size:12px;padding:2px 6px;" aria-label="Tutup notifikasi">&times;</button>
        `;
        container.appendChild(toast);
        setTimeout(() => dismissToast(toast), 4500);
    }

    function dismissToast(toast) {
        if (!toast || toast.classList.contains('removing')) return;
        toast.classList.add('removing');
        toast.addEventListener('animationend', () => toast.remove(), { once: true });
    }

    /* ===================== FORM VALIDATION ===================== */
    function setFieldState(input, valid, errorId, message) {
        const errEl = document.getElementById(errorId);
        input.classList.toggle('input-error', !valid);
        input.classList.toggle('input-ok', valid);
        if (errEl) {
            errEl.textContent = message || errEl.textContent;
            errEl.classList.toggle('visible', !valid);
        }
    }

    function validatePengajuanForm() {
        let ok = true;
        const nama = document.getElementById('nama_kompetisi');
        const peny = document.getElementById('penyelenggara');
        const tgl  = document.getElementById('tanggal');

        if (!nama.value.trim()) { setFieldState(nama, false, 'err-nama', 'Nama kompetisi wajib diisi.'); ok = false; }
        else                     { setFieldState(nama, true,  'err-nama'); }

        if (!peny.value.trim()) { setFieldState(peny, false, 'err-penyelenggara', 'Penyelenggara wajib diisi.'); ok = false; }
        else                     { setFieldState(peny, true,  'err-penyelenggara'); }

        if (!tgl.value) { setFieldState(tgl, false, 'err-tanggal', 'Tanggal wajib diisi.'); ok = false; }
        else             { setFieldState(tgl, true,  'err-tanggal'); }

        return ok;
    }

    function validateProfilForm() {
        let ok = true;
        const email   = document.getElementById('email');
        const newPw   = document.getElementById('new_password');
        const confirm = document.getElementById('confirm_password');
        const emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailRe.test(email.value)) { setFieldState(email, false, 'err-email', 'Format email tidak valid.'); ok = false; }
        else                             { setFieldState(email, true,  'err-email'); }

        if (newPw.value && newPw.value !== confirm.value) {
            setFieldState(confirm, false, 'err-confirm', 'Kata sandi tidak cocok.'); ok = false;
        } else {
            setFieldState(confirm, true, 'err-confirm');
        }

        return ok;
    }

    /* Real-time blur validation */
    document.addEventListener('DOMContentLoaded', () => {
        const pengajuanFields = [
            { id: 'nama_kompetisi', errId: 'err-nama',         check: v => v.trim() !== '', msg: 'Nama kompetisi wajib diisi.' },
            { id: 'penyelenggara',  errId: 'err-penyelenggara', check: v => v.trim() !== '', msg: 'Penyelenggara wajib diisi.' },
            { id: 'tanggal',        errId: 'err-tanggal',       check: v => v !== '',        msg: 'Tanggal wajib diisi.' },
        ];
        pengajuanFields.forEach(({ id, errId, check, msg }) => {
            const el = document.getElementById(id);
            if (!el) return;
            el.addEventListener('blur', () => setFieldState(el, check(el.value), errId, msg));
            el.addEventListener('input', () => { if (el.classList.contains('input-error')) setFieldState(el, check(el.value), errId, msg); });
        });

        const emailEl = document.getElementById('email');
        if (emailEl) {
            emailEl.addEventListener('blur', () => {
                const ok = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailEl.value);
                setFieldState(emailEl, ok, 'err-email', 'Format email tidak valid.');
            });
        }

        /* Password match live check */
        const confirmEl = document.getElementById('confirm_password');
        const newPwEl   = document.getElementById('new_password');
        if (confirmEl && newPwEl) {
            confirmEl.addEventListener('input', () => {
                if (newPwEl.value && confirmEl.value) {
                    setFieldState(confirmEl, newPwEl.value === confirmEl.value, 'err-confirm', 'Kata sandi tidak cocok.');
                }
            });
        }
    });

    /* ===================== PENGAJUAN FORM SUBMIT ===================== */
    document.getElementById('pengajuan-form').addEventListener('submit', function(e) {
        e.preventDefault();
        if (!validatePengajuanForm()) {
            showToast('error', 'Mohon lengkapi semua kolom yang wajib diisi.', 'Validasi');
            return;
        }

        const btn     = document.getElementById('submit-btn');
        const spinner = document.getElementById('submit-spinner');
        const icon    = document.getElementById('submit-icon');
        const label   = document.getElementById('submit-label');

        btn.disabled = true;
        spinner.style.display = 'block';
        icon.style.display    = 'none';
        label.textContent     = 'Mengirim...';

        /* Simulate submit — remove timeout in real use and let form POST */
        setTimeout(() => {
            btn.disabled = false;
            spinner.style.display = 'none';
            icon.style.display    = '';
            label.textContent     = 'Kirim Pengajuan Prestasi';
            showToast('success', 'Pengajuan berhasil dikirim dan sedang menunggu verifikasi.', 'Berhasil');
            /* this.submit(); ← uncomment in production */
        }, 1800);
    });

    /* ===================== PROFIL FORM SUBMIT ===================== */
    document.getElementById('profil-form').addEventListener('submit', function(e) {
        e.preventDefault();
        if (!validateProfilForm()) {
            showToast('error', 'Periksa kembali data yang dimasukkan.', 'Validasi');
            return;
        }

        const btn     = document.getElementById('profil-submit-btn');
        const spinner = document.getElementById('profil-spinner');
        const icon    = document.getElementById('profil-icon');
        const label   = document.getElementById('profil-label');

        btn.disabled = true;
        spinner.style.display = 'block';
        icon.style.display    = 'none';
        label.textContent     = 'Menyimpan...';

        setTimeout(() => {
            btn.disabled = false;
            spinner.style.display = 'none';
            icon.style.display    = '';
            label.textContent     = 'Simpan Perubahan';
            showToast('success', 'Profil berhasil diperbarui.', 'Tersimpan');
        }, 1500);
    });

    /* ===================== CONFIRM RESET ===================== */
    function confirmReset() {
        const modal    = document.getElementById('confirm-modal');
        const cancelBtn = document.getElementById('confirm-cancel');
        const okBtn    = document.getElementById('confirm-ok');

        modal.classList.add('open');

        const close = () => modal.classList.remove('open');
        cancelBtn.onclick = close;
        okBtn.onclick = () => {
            document.getElementById('pengajuan-form').reset();
            document.getElementById('label-cert').innerHTML  = defaultUploadHTML('fa-file-pdf', 'Sertifikat (PDF - Bisa pilih banyak)');
            document.getElementById('label-photo').innerHTML = defaultUploadHTML('fa-image', 'Foto Dokumentasi (Bisa pilih banyak)');
            ['nama_kompetisi','penyelenggara','tanggal'].forEach(id => {
                const el = document.getElementById(id);
                if (el) { el.classList.remove('input-error','input-ok'); }
            });
            document.querySelectorAll('.field-error').forEach(el => el.classList.remove('visible'));
            close();
            showToast('info', 'Formulir telah direset.', 'Reset');
        };

        modal.onclick = (e) => { if (e.target === modal) close(); };
    }

    function defaultUploadHTML(icon, label) {
        return `<i class="fas ${icon} text-4xl text-slate-300 mb-3 group-hover:text-blue-500"></i>
                <p class="text-[10px] font-black uppercase text-slate-500 tracking-widest">${label}</p>
                <span class="mt-4 inline-block px-6 py-2 bg-white border border-slate-200 rounded-xl text-xs font-bold shadow-sm">Pilih File</span>`;
    }

    /* ===================== FILE UPLOAD UX ===================== */
    function updateFileName(input, targetId) {
        const target = document.getElementById(targetId);
        const files  = input.files;
        if (!files || !files.length) return;

        const displayMsg = files.length === 1 ? files[0].name : `${files.length} file terpilih`;
        target.innerHTML = `
            <i class="fas fa-check-circle text-4xl text-green-500 mb-3"></i>
            <p class="text-sm font-bold text-slate-700">${displayMsg}</p>
            <span class="mt-2 text-[10px] text-blue-500 font-bold uppercase tracking-tighter cursor-pointer">Ganti Semua</span>
        `;
        showToast('success', `${displayMsg} siap diunggah.`, 'File Dipilih');
    }

    /* Drag & Drop */
    function setupDragDrop(zoneId, inputId, labelId) {
        const zone  = document.getElementById(zoneId);
        const input = document.getElementById(inputId);
        if (!zone || !input) return;

        ['dragenter','dragover'].forEach(evt => {
            zone.addEventListener(evt, e => { e.preventDefault(); zone.classList.add('dragover'); });
        });
        ['dragleave','dragend','drop'].forEach(evt => {
            zone.addEventListener(evt, e => {
                e.preventDefault();
                zone.classList.remove('dragover');
                if (evt === 'drop') {
                    const dt = e.dataTransfer;
                    if (dt && dt.files.length) {
                        input.files = dt.files;
                        updateFileName(input, labelId);
                    }
                }
            });
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        setupDragDrop('zone-cert',  'file-cert',   'label-cert');
        setupDragDrop('zone-photo', 'file-photo',  'label-photo');
    });

    /* ===================== PASSWORD STRENGTH ===================== */
    function updatePasswordStrength(val) {
        const bar   = document.getElementById('pw-strength-bar');
        const label = document.getElementById('pw-strength-label');
        if (!bar || !label) return;

        if (!val) { bar.style.width = '0%'; label.textContent = ''; return; }

        let score = 0;
        if (val.length >= 8)           score++;
        if (/[A-Z]/.test(val))         score++;
        if (/[0-9]/.test(val))         score++;
        if (/[^A-Za-z0-9]/.test(val))  score++;

        const levels = [
            { pct: '25%', color: '#ef4444', text: 'Sangat lemah' },
            { pct: '50%', color: '#f59e0b', text: 'Lemah' },
            { pct: '75%', color: '#3b82f6', text: 'Cukup kuat' },
            { pct: '100%',color: '#22c55e', text: 'Sangat kuat' },
        ];
        const lvl = levels[Math.max(0, score - 1)];
        bar.style.width      = lvl.pct;
        bar.style.background = lvl.color;
        label.textContent    = lvl.text;
        label.style.color    = lvl.color;
    }

    /* ===================== AVATAR MODAL ===================== */
    function toggleAvatarModal() {
        const modal = document.getElementById('avatar-modal');
        modal.classList.toggle('hidden');
        if (!modal.classList.contains('hidden')) {
            modal.querySelector('button[aria-label="Tutup modal"]').focus();
        }
    }

    function selectAvatar(url) {
        document.getElementById('current-avatar').src = url;
        document.getElementById('selected-avatar-input').value = url;

        document.querySelectorAll('.avatar-btn').forEach(btn => btn.classList.remove('avatar-btn-selected'));
        event.currentTarget.classList.add('avatar-btn-selected');

        toggleAvatarModal();
        showToast('success', 'Foto profil berhasil diubah. Simpan perubahan untuk menyimpan.', 'Avatar Diubah');
    }

    /* Close avatar modal on backdrop click */
    document.getElementById('avatar-modal').addEventListener('click', function(e) {
        if (e.target === this) toggleAvatarModal();
    });

    /* ===================== LOGOUT CONFIRM ===================== */
    function confirmLogout(e) {
        if (!confirm('Apakah Anda yakin ingin keluar dari sistem?')) {
            e.preventDefault();
            return false;
        }
        return true;
    }

    /* ===================== KEYBOARD NAV FOR SIDEBAR ===================== */
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('keydown', e => {
            if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); link.click(); }
        });
    });

    /* Close confirm modal on Escape */
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            document.getElementById('confirm-modal').classList.remove('open');
            const avatarModal = document.getElementById('avatar-modal');
            if (!avatarModal.classList.contains('hidden')) toggleAvatarModal();
        }
    });
    </script>
</body>
</html>