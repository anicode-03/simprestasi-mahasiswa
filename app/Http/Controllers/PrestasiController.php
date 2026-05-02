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
    /**
     * Tampilkan daftar prestasi
     */
    public function index()
    {
        $user = Auth::user();

        $query = Prestasi::with([
            'mahasiswa.user',
            'kategori',
            'tingkat',
            'capaian',
            'verifier'
        ])->latest();

        // mahasiswa hanya lihat miliknya
        if ($user->isMahasiswa()) {
            $query->where('mahasiswa_id', $user->mahasiswa->id);
        }

        $prestasi = $query->paginate(10);

        return view('prestasi.index', compact('prestasi'));
    }

    /**
     * Form tambah
     */
    public function create()
    {
        return view('prestasi.create', [
            'kategori' => Kategori::all(),
            'tingkat'  => Tingkat::all(),
            'capaian'  => Capaian::all(),
        ]);
    }

    /**
     * Simpan data
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'tingkat_id'  => 'required|exists:tingkat,id',
            'capaian_id'  => 'required|exists:capaian,id',
            'nama_kompetisi' => 'required|string|max:255',
            'penyelenggara' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'tanggal_pelaksanaan' => 'required|date',
            'deskripsi' => 'nullable|string',
            'bukti.*' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        // simpan prestasi
        $prestasi = Prestasi::create([
            'mahasiswa_id' => $user->mahasiswa->id,
            'kategori_id'  => $request->kategori_id,
            'tingkat_id'   => $request->tingkat_id,
            'capaian_id'   => $request->capaian_id,
            'nama_kompetisi' => $request->nama_kompetisi,
            'penyelenggara'  => $request->penyelenggara,
            'lokasi'         => $request->lokasi,
            'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
            'deskripsi' => $request->deskripsi,
            'status' => 'pending',
        ]);

        // upload bukti (bisa banyak file)
        if ($request->hasFile('bukti')) {
            foreach ($request->file('bukti') as $file) {
                $path = $file->store('bukti', 'public');

                BuktiPrestasi::create([
                    'prestasi_id' => $prestasi->id,
                    'file_path'   => $path,
                    'tipe_file'   => $file->getClientOriginalExtension(),
                ]);
            }
        }

        return redirect()->route('prestasi.index')
            ->with('success', 'Prestasi berhasil diajukan!');
    }

    /**
     * Detail
     */
    public function show(Prestasi $prestasi)
    {
        $this->authorizeOwner($prestasi);

        $prestasi->load([
            'mahasiswa.user',
            'kategori',
            'tingkat',
            'capaian',
            'bukti',
            'verifier'
        ]);

        return view('prestasi.show', compact('prestasi'));
    }

    /**
     * Form edit
     */
    public function edit(Prestasi $prestasi)
    {
        $this->authorizeOwner($prestasi);

        return view('prestasi.edit', [
            'prestasi' => $prestasi,
            'kategori' => Kategori::all(),
            'tingkat'  => Tingkat::all(),
            'capaian'  => Capaian::all(),
        ]);
    }

    /**
     * Update data
     */
    public function update(Request $request, Prestasi $prestasi)
    {
        $this->authorizeOwner($prestasi);

        $request->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'tingkat_id'  => 'required|exists:tingkat,id',
            'capaian_id'  => 'required|exists:capaian,id',
            'nama_kompetisi' => 'required|string|max:255',
            'penyelenggara' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'tanggal_pelaksanaan' => 'required|date',
            'deskripsi' => 'nullable|string',
            'bukti.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        $prestasi->update([
            'kategori_id' => $request->kategori_id,
            'tingkat_id'  => $request->tingkat_id,
            'capaian_id'  => $request->capaian_id,
            'nama_kompetisi' => $request->nama_kompetisi,
            'penyelenggara'  => $request->penyelenggara,
            'lokasi'         => $request->lokasi,
            'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
            'deskripsi' => $request->deskripsi,
            'status' => 'pending', // reset
            'verified_by' => null,
            'verified_at' => null
        ]);

        // upload ulang file
        if ($request->hasFile('bukti')) {
            foreach ($prestasi->bukti as $bukti) {
                Storage::disk('public')->delete($bukti->file_path);
                $bukti->delete();
            }

            foreach ($request->file('bukti') as $file) {
                $path = $file->store('bukti', 'public');

                BuktiPrestasi::create([
                    'prestasi_id' => $prestasi->id,
                    'file_path'   => $path,
                    'tipe_file'   => $file->getClientOriginalExtension(),
                ]);
            }
        }

        return redirect()->route('prestasi.index')
            ->with('success', 'Prestasi berhasil diperbarui');
    }

    /**
     * Hapus
     */
    public function destroy(Prestasi $prestasi)
    {
        $this->authorizeOwner($prestasi);

        foreach ($prestasi->bukti as $bukti) {
            Storage::disk('public')->delete($bukti->file_path);
        }

        $prestasi->delete();

        return redirect()->route('prestasi.index')
            ->with('success', 'Prestasi berhasil dihapus');
    }

    /**
     * Approve admin
     */
    public function approve($id)
    {
        $prestasi = Prestasi::findOrFail($id);

        $prestasi->update([
            'status' => 'disetujui',
            'verified_by' => Auth::id(),
            'verified_at' => now()
        ]);

        return back()->with('success', 'Prestasi disetujui');
    }

    /**
     * Reject admin
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'catatan_admin' => 'required|string|max:500'
        ]);

        $prestasi = Prestasi::findOrFail($id);

        $prestasi->update([
            'status' => 'ditolak',
            'catatan_admin' => $request->catatan_admin,
            'verified_by' => Auth::id(),
            'verified_at' => now()
        ]);

        return back()->with('success', 'Prestasi ditolak');
    }

    public function revisi(Request $request, $id)
    {
        $prestasi = Prestasi::findOrFail($id);

        $request->validate([
            'catatan_admin' => 'required|string'
        ]);

        $prestasi->update([
            'status' => 'revisi',
            'catatan_admin' => $request->catatan_admin,
            'verified_by' => Auth::id(),
            'verified_at' => now()
        ]);

        return back()->with('success', 'Prestasi diminta revisi');
    }

    /**
     * Cek kepemilikan data
     */
    private function authorizeOwner(Prestasi $prestasi)
    {
        $user = Auth::user();

        if ($user->isMahasiswa() && $prestasi->mahasiswa_id !== $user->mahasiswa->id) {
            abort(403, 'Tidak punya akses');
        }
    }
}
