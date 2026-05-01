<?php

namespace App\Http\Controllers;


use App\Models\TingkatPrestasi;
use Illuminate\Http\Request;

class TingkatPrestasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tingkat = TingkatPrestasi::latest()->paginate(10);
        return view('tingkat-prestasi.index', compact('tingkat'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tingkat-prestasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama-tingkat' => 'required|string|max:100|unique:tingkat_prestasi,nama_tingkat',
        ]);

        TingkatPrestasi::create($validated);

        return redirect()->route('tingkat-prestasi.index')
            ->with('success', 'Tingkat prestasi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TingkatPrestasi $tingkatPrestasi)
    {
        return view('tingkat-prestasi.show', compact('tingkatPrestasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TingkatPrestasi $tingkatPrestasi)
    {
        return view('tingkat-prestasi.edit', compact('tingkatPrestasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TingkatPrestasi $tingkatPrestasi)
    {
        $validated = $request->validate([
            'nama_tingkat' => 'required|string|max:100|unique:tingkat_prestasi,nama_tingkat,' . $tingkatPrestasi->id_tingkat . ',id_tingkat',
        ]);

        $tingkatPrestasi->update($validated);

        return redirect()->route('tingkat-prestasi.index')
            ->with('success', 'Tingkat prestasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TingkatPrestasi $tingkatPrestasi)
    {
        $tingkatPrestasi->delete();

        return redirect()->route('tingkat-prestasi.index')
            ->with('success', 'Tingkat prestasi berhasil dihapus.');
    }
}
