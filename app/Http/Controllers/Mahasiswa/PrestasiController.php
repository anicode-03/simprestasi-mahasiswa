<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Models\Prestasi;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\TingkatPrestasi;
use App\Models\BuktiPrestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PrestasiController extends Controller
{
    // menampilkan data prestasi
    public function index() {
    $prestasi = Prestasi::where('user_id', Auth::id())->get();
    return view('mahasiswa.prestasi.index', compact('prestasi'));
    }

    // menampilkan form tambah prestasi
    public function create() {
    $categories = Category::all();
    $tingkat = TingkatPrestasi::all();
    return view('mahasiswa.prestasi.create', compact('categories', 'tingkat'));
    }

    //menyimpan data prestasi baru
    public function store(Request $request) {

        //validasi input
        $request->validate([
            'nama_kegiatan'   =>'required',
            'id_kategori'     =>'required',
            'id_tingkat'      =>'required',
            'peran'           =>'required',
            'tanggal'         =>'required|date',
            'lokasi_kegiatan' =>'required',
            'penyelenggara'   =>'required',
            'dok_sertifikat'  =>'required|file|mimes:pdf,jpg,png|max:2048',
            'dok_kegiatan'    =>'required|file|mimes:pdf,jpg,png|max:2048',
        ]);


        //membuat Id prestasi custom
        $id_prestasi = 'PRS-' . date('Y') . '-' . strtoupper(Str::random(5));

        $prestasi = Prestasi::create([
            'id_prestasi'     => $id_prestasi,
            'nama_kegiatan'   => $request->nama_kegiatan,
            'user_id'         => Auth::id(),
            'id_kategori'     => $request->id_kategori,
            'id_tingkat'      => $request->id_tingkat,
            'peran'           => $request->peran,
            'juara'           => $request->juara,
            'tanggal'         => $request->tanggal,
            'tahun_kegiatan'  => date('Y', strtotime($request->tanggal)),
            'penyelenggara'   => $request->penyelenggara,
            'lokasi_kegiatan' => $request->lokasi_kegiatan,
            'deskripsi'       => $request->deskripsi,
            'status'          => 'diajukan',
        ]);


        //proses upload file 
        $fileSertifikat = $request->file('dok_sertifikat')->store('bukti_sertifikat', 'public');
        $fileKegiatan   = $request->file('dok_kegiatan')->store('bukti_kegiatan', 'public');

        // Simpan ke tabel BuktiPrestasi
        BuktiPrestasi::create([
            'id_bukti'       => 'BKT-' . strtoupper(Str::random(8)),
            'id_prestasi'    => $id_prestasi,
            'dok_sertifikat' => $fileSertifikat,
            'dok_kegiatan'   => $fileKegiatan,
        ]);

        return redirect()->route('prestasi.index')->with('success', 'Prestasi berhasil diajukan!');

    }
}


