{{-- resources/views/mahasiswa/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
    :root { --primary: #1e3a8a; --primary-light: #3b82f6; --bg-main: #f8fafc; --sidebar-width: 280px; }
    body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: var(--bg-main); color: #1e293b; }
    .custom-scroll::-webkit-scrollbar { width: 6px; }
    .custom-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    .bg-primary { background-color: var(--primary); }
    .text-primary { color: var(--primary); }
    .border-primary { border-color: var(--primary); }
    .sidebar { background-color: #1e3a8a; transition: all 0.3s ease; }
    .nav-link { transition: all 0.3s ease; position: relative; }
    .nav-link.active { background: white; color: #1e3a8a; border-radius: 30px 0 0 30px; font-weight: 700; }
    .nav-link.active::after { content: ''; position: absolute; right: 0; top: -30px; width: 30px; height: 30px; background: transparent; border-radius: 50%; box-shadow: 15px 15px 0 white; }
    .nav-link.active::before { content: ''; position: absolute; right: 0; bottom: -30px; width: 30px; height: 30px; background: transparent; border-radius: 50%; box-shadow: 15px -15px 0 white; }
    .profile-card { background: #ffffff; border-radius: 32px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.05), 0 10px 10px -5px rgba(0,0,0,0.04); margin-top: 100px; padding: 100px 40px 40px 40px; position: relative; border: 1px solid rgba(255,255,255,0.5); }
    .profile-img-container { width: 180px; height: 180px; background: #e2e8f0; border-radius: 50%; position: absolute; top: -90px; left: 50%; transform: translateX(-50%); border: 8px solid white; box-shadow: 0 15px 30px rgba(0,0,0,0.1); overflow: hidden; display: flex; align-items: flex-end; justify-content: center; }
    .achievement-card { background: white; border-radius: 32px; height: 100%; display: flex; flex-direction: column; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.05); border: 1px solid #f1f5f9; }
    .podium-container { background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-radius: 24px; padding: 20px; display: flex; justify-content: center; align-items: center; margin-bottom: 24px; }
    .scroll-area { max-height: calc(100vh - 450px); overflow-y: auto; padding-right: 10px; }
    .scroll-area::-webkit-scrollbar { width: 4px; }
    .scroll-area::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    .badge-rank { padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; }
    .badge-gold { background: #fef3c7; color: #92400e; }
    .badge-silver { background: #f1f5f9; color: #475569; }
    .badge-bronze { background: #ffedd5; color: #9a3412; }
    .section-transition { animation: fadeSlideIn 0.25s ease forwards; }
    @keyframes fadeSlideIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
    #toast-container { position: fixed; bottom: 28px; right: 28px; z-index: 9999; display: flex; flex-direction: column; gap: 10px; pointer-events: none; }
    .toast { display: flex; align-items: center; gap: 12px; padding: 14px 20px; border-radius: 16px; background: white; box-shadow: 0 8px 30px rgba(0,0,0,0.12); font-size: 13px; font-weight: 600; color: #1e293b; border: 1px solid #f1f5f9; pointer-events: all; animation: toastIn 0.3s cubic-bezier(0.34,1.56,0.64,1) forwards; min-width: 260px; max-width: 360px; }
    .toast.removing { animation: toastOut 0.25s ease forwards; }
    .toast-icon { width: 28px; height: 28px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 13px; flex-shrink: 0; }
    .toast-success .toast-icon { background: #dcfce7; color: #16a34a; }
    .toast-error   .toast-icon { background: #fee2e2; color: #dc2626; }
    .toast-info    .toast-icon { background: #dbeafe; color: #2563eb; }
    .toast-warning .toast-icon { background: #fef3c7; color: #d97706; }
    @keyframes toastIn { from { opacity: 0; transform: translateX(30px) scale(0.95); } to { opacity: 1; transform: translateX(0) scale(1); } }
    @keyframes toastOut { from { opacity: 1; transform: translateX(0) scale(1); } to { opacity: 0; transform: translateX(30px) scale(0.95); } }
    .field-error { font-size: 11px; color: #dc2626; font-weight: 600; margin-top: 4px; margin-left: 4px; display: none; }
    .field-error.visible { display: block; animation: fadeSlideIn 0.2s ease; }
    input.input-error, select.input-error, textarea.input-error { border-color: #fca5a5 !important; background: #fff5f5 !important; }
    input.input-ok, select.input-ok, textarea.input-ok { border-color: #86efac !important; }
    .btn-spinner { width: 16px; height: 16px; border: 2px solid rgba(255,255,255,0.4); border-top-color: white; border-radius: 50%; animation: spin 0.7s linear infinite; display: none; }
    @keyframes spin { to { transform: rotate(360deg); } }
    .upload-zone.dragover { border-color: #3b82f6 !important; background: #eff6ff !important; }
    .upload-zone.dragover * { pointer-events: none; }
    .nav-link:focus-visible { outline: 2px solid rgba(255,255,255,0.6); outline-offset: -3px; border-radius: 12px; }
    #confirm-modal { position: fixed; inset: 0; z-index: 9998; display: flex; align-items: center; justify-content: center; background: rgba(15,23,42,0.4); backdrop-filter: blur(4px); opacity: 0; pointer-events: none; transition: opacity 0.2s ease; }
    #confirm-modal.open { opacity: 1; pointer-events: all; }
    #confirm-modal .modal-box { background: white; border-radius: 28px; padding: 32px; width: 360px; box-shadow: 0 25px 50px rgba(0,0,0,0.15); transform: scale(0.95); transition: transform 0.2s cubic-bezier(0.34,1.56,0.64,1); }
    #confirm-modal.open .modal-box { transform: scale(1); }
    .avatar-btn-selected { border-color: #1e3a8a !important; box-shadow: 0 0 0 3px rgba(30,58,138,0.2); }
    #pw-strength-bar { height: 4px; border-radius: 4px; transition: width 0.3s ease, background 0.3s ease; width: 0%; }
</style>
@endpush

@section('body-class', 'flex min-h-screen')

@section('content')
{{-- TOAST CONTAINER --}}
<div id="toast-container" aria-live="polite" aria-atomic="true"></div>

{{-- CONFIRM MODAL --}}
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

{{-- SIDEBAR --}}
@include('components.sidebar-mahasiswa')

{{-- MAIN CONTENT --}}
<main class="ml-[5px] flex-1 p-10 h-screen flex flex-col gap-8 min-h-0">

    {{-- HEADER --}}
    <header class="flex justify-between items-center -mt-3">
        <div>
            <h1 id="header-title" class="text-2xl font-extrabold text-slate-800 tracking-tight">
                Selamat Datang, <span class="text-blue-700">{{ Auth::user()->name }}!</span>
            </h1>
            <p id="header-subtitle" class="text-sm text-slate-500">Pantau terus perkembangan prestasimu hari ini.</p>
        </div>
        <div class="flex items-center gap-2">
            <button class="relative p-2 bg-white border border-slate-200 rounded-xl text-slate-600 hover:bg-slate-50 transition-colors" aria-label="Notifikasi" title="Notifikasi">
                <i class="fas fa-bell" aria-hidden="true"></i>
                <span class="absolute top-3 right-2 w-2 h-2 bg-red-500 border-2 border-white rounded-full"></span>
            </button>
            <div class="h-10 w-10 bg-blue-100 rounded-xl flex items-center justify-center text-blue-700 font-bold border border-blue-200" title="{{ Auth::user()->name }}">
                @php
                    $words = explode(' ', Auth::user()->name);
                    $initials = count($words) >= 2
                        ? strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1))
                        : strtoupper(substr($words[0], 0, 2));
                @endphp
                {{ $initials }}
            </div>
        </div>
    </header>

    {{-- DASHBOARD SECTION --}}
    @include('mahasiswa.partials.section-dashboard')

    {{-- PENGAJUAN SECTION --}}
    @include('mahasiswa.partials.section-pengajuan')

    {{-- PENGATURAN SECTION --}}
    @include('mahasiswa.partials.section-pengaturan')

</main>

{{-- AVATAR MODAL --}}
@include('mahasiswa.partials.modal-avatar')

@endsection

@push('scripts')
@include('mahasiswa.partials.scripts')
@endpush