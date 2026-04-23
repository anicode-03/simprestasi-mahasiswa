<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
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

                    <!-- Info Admin -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold">🔐 Halo, {{ Auth::user()->name }} (Admin)!</h3>
                        <p class="text-gray-600">
                            <strong>Email:</strong> {{ Auth::user()->email }}
                        </p>
                    </div>

                    <!-- Menu Admin -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="{{ route('verifikasi.index') }}" 
                           class="block p-4 bg-purple-50 hover:bg-purple-100 rounded-lg border border-purple-200 transition">
                            <h4 class="font-semibold text-purple-800">✅ Verifikasi Prestasi</h4>
                            <p class="text-sm text-purple-600">Review dan setujui pengajuan mahasiswa</p>
                        </a>

                        <a href="{{ route('kategori.index') }}" 
                           class="block p-4 bg-blue-50 hover:bg-blue-100 rounded-lg border border-blue-200 transition">
                            <h4 class="font-semibold text-blue-800">📁 Kelola Kategori</h4>
                            <p class="text-sm text-blue-600">Tambah/edit kategori prestasi</p>
                        </a>

                        <a href="{{ route('tingkat-prestasi.index') }}" 
                           class="block p-4 bg-green-50 hover:bg-green-100 rounded-lg border border-green-200 transition">
                            <h4 class="font-semibold text-green-800">🏆 Kelola Tingkat</h4>
                            <p class="text-sm text-green-600">Atur tingkat prestasi (Nasional, Internasional, dll)</p>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>