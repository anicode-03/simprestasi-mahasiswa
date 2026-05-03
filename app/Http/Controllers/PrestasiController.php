<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\Kategori;
use App\Models\Tingkat;
use App\Models\Capaian;
use App\Models\BuktiPrestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PrestasiController extends Controller
{
    public function index()
    {
        $user     = Auth::user();
        $kategori = Kategori::all();
        $tingkat  = Tingkat::all();
        $capaian  = Capaian::all();

        $query = Prestasi::with([
            'mahasiswa.user',
            'kategori',
            'tingkat',
            'capaian',
            'verifier',
        ])->latest();

        if ($user->role === 'mahasiswa') {
            $query->where('mahasiswa_id', $user->mahasiswa->id);
        }

        $prestasi = $query->paginate(10);

        return view('mahasiswa.dashboard', compact('prestasi', 'kategori', 'tingkat', 'capaian'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama_kompetisi'    => 'required|string|max:255',
            'penyelenggara'     => 'required|string|max:255',
            'kategori_id'       => 'required|exists:kategoris,id',
            'tingkat_id'        => 'required|exists:tingkats,id',
            'capaian_id'        => 'required|exists:capaians,id',
            'tanggal'           => 'required|date',
            'dosen'             => 'nullable|string|max:255',
            'lokasi'            => 'nullable|string|max:255',
            'link_pendukung'    => 'nullable|url|max:255',
            'deskripsi'         => 'nullable|string|max:1000',
            'file_sertifikat.*' => 'nullable|file|mimes:pdf|max:5120',
            'file_foto.*'       => 'nullable|file|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $prestasi = Prestasi::create([
            'mahasiswa_id'        => $user->mahasiswa->id,
            'kategori_id'         => $request->kategori_id,
            'tingkat_id'          => $request->tingkat_id,
            'capaian_id'          => $request->capaian_id,
            'nama_kompetisi'      => $request->nama_kompetisi,
            'penyelenggara'       => $request->penyelenggara,
            'dosen_pembimbing'    => $request->dosen,
            'lokasi'              => $request->lokasi,
            'tanggal_pelaksanaan' => $request->tanggal,
            'link_pendukung'      => $request->link_pendukung,
            'deskripsi'           => $request->deskripsi,
            'status'              => 'pending',
        ]);

        if ($request->hasFile('file_sertifikat')) {
            foreach ($request->file('file_sertifikat') as $file) {
                $path = $file->store('bukti/sertifikat', 'public');
                BuktiPrestasi::create([
                    'prestasi_id' => $prestasi->id,
                    'file_path'   => $path,
                    'tipe_file'   => 'sertifikat',
                ]);
            }
        }

        if ($request->hasFile('file_foto')) {
            foreach ($request->file('file_foto') as $file) {
                $path = $file->store('bukti/foto', 'public');
                BuktiPrestasi::create([
                    'prestasi_id' => $prestasi->id,
                    'file_path'   => $path,
                    'tipe_file'   => 'foto',
                ]);
            }
        }

        return redirect()->back()->with([
            'success' => 'Prestasi berhasil diajukan!',
            'last_section' => 'pengajuan' // Tambahkan penanda ini
        ]);
    }

    public function show(int $id)
    {
        $prestasi = Prestasi::with([
            'mahasiswa.user',
            'kategori',
            'tingkat',
            'capaian',
            'buktis',           // relasi ke tabel bukti_prestasi
            'verifier',
        ])->findOrFail($id);

        $this->authorizeOwner($prestasi);

        return view('mahasiswa.prestasi.show', compact('prestasi'));
    }

    public function approve(int $id)
    {
        $prestasi = Prestasi::findOrFail($id);

        $prestasi->update([
            'status'      => 'disetujui',
            'verified_by' => Auth::id(),
            'verified_at' => now(),
        ]);

        return back()->with('success', 'Prestasi disetujui.');
    }

    public function reject(Request $request, int $id)
    {
        $request->validate([
            'catatan_admin' => 'required|string|max:500',
        ]);

        $prestasi = Prestasi::findOrFail($id);

        $prestasi->update([
            'status'        => 'ditolak',
            'catatan_admin' => $request->catatan_admin,
            'verified_by'   => Auth::id(),
            'verified_at'   => now(),
        ]);

        return back()->with('success', 'Prestasi ditolak.');
    }

    public function revisi(Request $request, int $id)
    {
        $request->validate([
            'catatan_admin' => 'required|string|max:500',
        ]);

        $prestasi = Prestasi::findOrFail($id);

        $prestasi->update([
            'status'        => 'revisi',
            'catatan_admin' => $request->catatan_admin,
            'verified_by'   => Auth::id(),
            'verified_at'   => now(),
        ]);

        return back()->with('success', 'Prestasi dikembalikan untuk revisi.');
    }

    private function authorizeOwner(Prestasi $prestasi)
    {
        $user = Auth::user();
        if ($user->role === 'mahasiswa' && $prestasi->mahasiswa_id !== $user->mahasiswa->id) {
            abort(403, 'Anda tidak memiliki akses ke data ini.');
        }
    }
}
