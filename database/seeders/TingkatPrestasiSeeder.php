<?php

namespace Database\Seeders;

use App\Models\TingkatPrestasi;
use Illuminate\Database\Seeder;

class TingkatPrestasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TingkatPrestasi::insert([
            ['id_tingkat' => 'T0011', 'nama_tingkat' => 'Internasional'],
            ['id_tingkat' => 'T0012', 'nama_tingkat' => 'Internasional'],
            ['id_tingkat' => 'T0013', 'nama_tingkat' => 'Nasional'],
        ]);
    }
}
