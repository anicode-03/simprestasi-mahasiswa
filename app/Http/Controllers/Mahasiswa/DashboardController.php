<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {

    $userId = Auth::id();
    
    //mengambil data statistik
    $data = [
        'total'       => Prestasi::where('user_id', $userId)->count(),
        'disetujui'   => Prestasi::where('user_id', $userId)->where('status', 'disetujui')->count(),
        'ditolak'     => Prestasi::where('user_id', $userId)->where('status', 'ditolak')->count(),
        'proses'      => Prestasi::where('user_id', $userId)->where('status', 'diajukan')->count(),
    ];
    return view('mahasiswa.dashboard', compact('data'));
    }
}
