<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use App\Models\DetailPengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class VerifikasiController extends Controller
{
    // menampilakn semua pengajuan
    public function index() {
    $pengajuan = Prestasi::with('mahasiswa', 'kategori')->orderBy('created_at', 'desc')->get();
    return view('admin.verifikasi.index', compact('pengajuan'));
    }


    //proses menyetujui dan menolak
    public function updateStatus(Request $request, $id) {
        $prestasi = Prestasi::where('id_prestasi', $id)->findOrFail($id);

        //update status di tabel prestasi
        $prestasi->update(['status' => $request->status]);

        //catat riwayat
        DetailPengajuan::create([
            'id_detail'       =>'LOG-' . strtoupper(Str::random(8)),
            'id_prestasi'    => $prestasi->id_prestasi,
            'user_id'        => Auth::id(),
            'status'         => $request->status,
            'catatan_admin'  => $request->catatan,
        ]);

        return redirect()->back()->with('success', 'Status Pengajuan berhasil diperbarui');
    }
    
}
