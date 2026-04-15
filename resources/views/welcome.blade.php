<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPRESMA POLIJE</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-900 text-white min-h-screen">
    <nav class="bg-gray-800 border-b border-gray-700 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold text-blue-400">SIMPRESMA <span class="text-white">POLIJE</span></h1>
            
            <div class="flex items-center gap-4">
                @auth
                    <span>Halo, {{ Auth::user()->nama_mahasiswa }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded text-sm transition">Logout</button>
                    </form>
                @endauth

                @guest
                    <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded text-sm transition">
                        Login
                    </a>
                @endguest
            </div>
        </div>
    </nav>

    <main class="container mx-auto mt-10 p-6 bg-gray-800 rounded-lg shadow-xl border border-gray-700">
        <h2 class="text-2xl font-semibold mb-4 text-blue-300">Selamat Datang di Portal Prestasi</h2>
        
        @auth
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                <a href="#" class="p-4 bg-blue-600 hover:bg-blue-700 rounded-lg text-center font-bold">
                    + Tambah Prestasi Baru
                </a>
                <a href="#" class="p-4 bg-gray-700 hover:bg-gray-600 rounded-lg text-center font-bold border border-gray-600">
                    Lihat Daftar Prestasi
                </a>
            </div>
        @else
            <p class="text-gray-400">Silakan login terlebih dahulu untuk mengelola prestasi Anda.</p>
        @endauth
    </main>
</body>
</html>