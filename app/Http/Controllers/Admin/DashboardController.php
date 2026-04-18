<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik global Admin
        $stats = [
            'total_mhs'      => User::where('role', 'mahasiswa')->count(),
            'total_prestasi' => Prestasi::count(),
            'butuh_verifikasi' => Prestasi::where('status', 'diajukan')->count(),
        ];

        // Ambil 5 pengajuan terbaru untuk ditampilkan di tabel dashboard
        $recent_activities = Prestasi::with('mahasiswa')->latest()->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_activities'));
    }
}
