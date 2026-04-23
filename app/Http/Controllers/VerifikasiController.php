<?php

namespace App\Http\Controllers;

use App\Models\DetailPengajuanPrestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifikasiController extends Controller
{
    public function index() {

    /** @var \App\Models\User $user */
    $user = Auth::user();
    if (!$user()->isAdmin()) {
        abort(403, 'Hanya admin yang dapat mengakses halaman ini');
    }

    $pengajuan = DetailPengajuanPrestasi::with(['prestasi.mahasiswa', 'prestasi.kategori', 'prestasi.tingkatPrestasi'])
        ->latest()
        ->paginate(15);
    
    return view('verifikasi.index', compact('pengajuan'));
    }


    public function update(Request $request, $id) {

        /** @var \App\Models\User $user */
        $user = Auth::user();
        if (!$user->isAdmin()) abort(403);

        $validated = $request->validate([
            'status' => 'required|in:diterima,ditolak,revisi',
            'catatan_admin' => 'nullable|string|max:50',
        ]);

        $detail = DetailPengajuanPrestasi::findOrFail($id);

        $detail->update([
            'status' => $validated['status'],
            'catatan_admin' => $validated['catatan_admin'] ?? null,
            'id_admin' => $user->id, //tanda admin memverifikasi
        ]);

        return redirect()->route('verifikasi.index')
            ->with('success', "Pengajuan berhasil diubah menjadi {$validated['status']}.");
    }
}
