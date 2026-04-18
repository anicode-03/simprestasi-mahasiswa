<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use illuminate\Http\Request;

class CategoryControlle extends Controller
{
    public function index() {
        $categories = Category::all();
        return view('admin.kategori.index', compact('categories'));
    }

    public function store(Request $request) {

        $request->validate([
            'nama_kategori' => 'required|unique:kategori,nama_kategori'
        ]);

        //logika membuat ID otomatis: KT + nomor urut
        $lastCategory = Category::orderBy('id_kategori', 'desc')->first();
        $lastNumber = $lastCategory ? intval(substr($lastCategory->id_kategori, 2)) : 120;
        $newId = 'KT' . ($lastNumber + 1);

        Category::create([
            'id_kategori' => $newId,
            'nama_kategori' => $request->nama_kategori
        ]);
        return redirect()->back()->with('success', 'kategori baru berhasil di tambahkan!');
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->back()->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        
        // Cek apakah kategori ini sedang digunakan di tabel prestasi
        if ($category->prestasi()->count() > 0) {
            return redirect()->back()->with('error', 'Kategori tidak bisa dihapus karena sudah digunakan dalam data prestasi.');
        }

        $category->delete();
        return redirect()->back()->with('success', 'Kategori berhasil dihapus!');
    }
}
