<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\Kategori;
use App\Models\TingkatPrestasi;
use App\Models\DetailPengajuanPrestasi;
use App\Models\BuktiPrestasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $user = Auth::user();
        
        //jika admin, melihat semua, jika mahasiswa hanya miliknya
        $query = Prestasi::with(['kategori', 'tingkatPrestasi', 'detailPengajuan'])
            ->latest('tgl_pengajuan');

        if ($user->isMahasiswa()) {
            $query->where('NIM', $user->NIM);
        }

        $prestasi = $query->paginate(10);
        return view('prestasi.index', compact('prestasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all();
        $tingkat = TingkatPrestasi::all();
        return view('prestasi.create', compact('kategori', 'tingkat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'id_tingkat'  => 'required|exists:tingkat_prestasi,id_tingkat',
            'nama_prestasi' => 'required|string|max:255',
            'penyelenggara' => 'required|string|max:255',
            'juara'       => 'required|string|max:50',
            'lokasi'      => 'required|string|max:255',
            'tgl_kegiatan'=> 'required|date',
            'deskripsi'   => 'nullable|string',
            'dok_sertifikat' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dok_kegiatan'   => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);


        //simpan prestasi
        $prestasi = Prestasi::create([
            'NIM'           => $user->NIM,
            'id_kategori'   => $validated['id_kategori'],
            'id_tingkat'    => $validated['id_tingkat'],
            'nama_prestasi' => $validated['nama_prestasi'],
            'penyelenggara' => $validated['penyelenggara'],
            'juara'         => $validated['juara'],
            'lokasi'        => $validated['lokasi'],
            'tgl_kegiatan'  => $validated['tgl_kegiatan'],
            'tgl_pengajuan' => now(),
            'deskripsi'     => $validated['deskripsi'] ?? null,
            'id_admin'      => null,
        ]);


        // simpan file bukti
        $pathSertifikat = $request->file('dok_sertifikat')->store('public/bukti_prestasi');
        $pathKegiatan = $request->hasFile('dok_kegiatan') ? $request->file('dok_kegiatan')->store('public/bukti_prestasi') : null;

        BuktiPrestasi::create([
            'id_prestasi'  =>  $prestasi->id_prestasi,
            'dok_sertifikat' => $pathSertifikat,
            'dok_kegiatan' => $pathKegiatan,
        ]);



        // status pending
        DetailPengajuanPrestasi::create([
            'id_prestasi'   => $prestasi->id_prestasi,
            'id_admin'      => null,
            'status'        => 'pending',
            'catatan_admin' => null,
        ]);

        return redirect()->route('prestasi.index')
            ->with('success', 'Prestasi berhasil diajukan! Menunggu verifikasi admin');
    }

    /**
     * Display the specified resource.
     */
    public function show(Prestasi $prestasi)
    {
        $this->authorizeView($prestasi);
        $prestasi->load(['kategori', 'buktiPrestasi', 'detailPengajuan.admin']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prestasi $prestasi)
    {
        $this->authorizeView($prestasi);
        $kategori = Kategori::all();
        $tingkat = TingkatPrestasi::all();
        return view('prestasi.edit', compact('prestasi', 'kategori', 'tingkat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prestasi $prestasi)
    {
        $this->authorizeView($prestasi);

        $validated = $request->validate([
            'id_kategori'   => 'required|exists:kategori,id_kategori',
            'id_tingkat'    => 'required|exists:tingkat_prestasi,id_tingkat',
            'nama_prestasi' => 'required|string|max:255',
            'penyelenggara' => 'required|string|max:255',
            'juara'         => 'required|string|max:50',
            'lokasi'        => 'required|string|max:255',
            'tgl_kegiatan'  => 'required|date',
            'deskripsi'     => 'nullable|string',
            'dok_sertifikat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dok_kegiatan'   => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $prestasi->update($validated);

        //update file jika upload ulang
        $bukti = $prestasi->BuktiPrestasi->first();
        if ($prestasi->hasFile('dok_sertifikat')) {
            $bukti->dok_sertifikat = $request->file('dok_sertifikat')->store('public/bukti_prestasi');
        }
        if ($request->hasFile('dok_kegiatan')) {
            $bukti->dok_kegiatan = $request->file('dok_kegiatan')->store('public/bukti_prestasi');
        }

        $bukti->save();

        // reset status ke pending jika data diedit
        $prestasi->detailPengajuan->first()->update([
            'status' => 'pending',
            'id_admin' => null,
            'catatan_admin' => null
        ]);

        return redirect()->route('prestasi.index')
            ->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prestasi $prestasi)
    {
        $this->authorizeView($prestasi);
        $prestasi->delete(); //aka hapus bukti & detail pengajuan
        return redirect()->route('prestasi.index')->with('success', 'Prestasi dihapus');
    }

    //helper sederhana untuk cek kepemilikan data
    private function authorizeView(Prestasi $prestasi) {
        
        $user = auth()->user();
            if ($user->isMahasiswa() && $prestasi->NIM !== $user->NIM) {
                abort(403, 'Anda tidak berhak mengakses data ini');
            }
        }
}

            
