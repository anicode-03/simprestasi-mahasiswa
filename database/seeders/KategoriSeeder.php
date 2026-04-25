<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kategori::insert([
            ['id_kategori' => 'K0900', 'nama_kategori' => 'Non Akademik'],
            ['id_kategori' => 'K0901', 'nama_kategori' => 'Akademik'],
            ['id_kategori' => 'K0902', 'nama_kategori' => 'Olahraga'],
        ]);
    }
}
