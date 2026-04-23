<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- Pesan Sukses -->
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Info User -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold">👋 Halo, {{ Auth::user()->name }}!</h3>
                        <p class="text-gray-600">
                            <strong>NIM:</strong> {{ Auth::user()->NIM }}<br>
                            <strong>Prodi:</strong> {{ Auth::user()->prodi }}<br>
                            <strong>Jurusan:</strong> {{ Auth::user()->jurusan }}<br>
                            <strong>Angkatan:</strong> {{ Auth::user()->angkatan }}
                        </p>
                    </div>

                    <!-- Menu Aksi -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a href="{{ route('prestasi.index') }}" 
                           class="block p-4 bg-blue-50 hover:bg-blue-100 rounded-lg border border-blue-200 transition">
                            <h4 class="font-semibold text-blue-800">📊 Kelola Prestasi</h4>
                            <p class="text-sm text-blue-600">Lihat, tambah, atau edit data prestasi Anda</p>
                        </a>

                        <a href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="block p-4 bg-red-50 hover:bg-red-100 rounded-lg border border-red-200 transition">
                            <h4 class="font-semibold text-red-800">🚪 Logout</h4>
                            <p class="text-sm text-red-600">Keluar dari akun Anda</p>
                        </a>
                    </div>

                    <!-- Form Logout (hidden) -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>