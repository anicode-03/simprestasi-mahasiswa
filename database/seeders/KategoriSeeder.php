<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['id_kategori' => 'K0900', 'nama_kategori' => 'Non Akademik'],
            ['id_kategori' => 'K0901', 'nama_kategori' => 'Akademik'],
            ['id_kategori' => 'K0902', 'nama_kategori' => 'Olahraga'],
            ['id_kategori' => 'K0903', 'nama_kategori' => 'Seni & Budaya'],
            ['id_kategori' => 'K0904', 'nama_kategori' => 'Teknologi'],
        ];

        foreach ($data as $row) {
            DB::table('kategori')->updateOrInsert(
                ['id_kategori' => $row['id_kategori']],
                [
                    'nama_kategori' => $row['nama_kategori'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
        $this->command->info('✅ KategoriSeeder selesai.');
    }
}
