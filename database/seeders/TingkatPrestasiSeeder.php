<?php

namespace Database\Seeders;

use App\Models\TingkatPrestasi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TingkatPrestasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['id_tingkat' => 'T0011', 'nama_tingkat' => 'Internasional'],
            ['id_tingkat' => 'T0012', 'nama_tingkat' => 'Internasional'],
            ['id_tingkat' => 'T0013', 'nama_tingkat' => 'Nasional'],
            ['id_tingkat' => 'T0014', 'nama_tingkat' => 'Kabupaten/Kota'],
            ['id_tingkat' => 'T0015', 'nama_tingkat' => 'Instansi'],
        ];

        foreach ($data as $row) {
            DB::table('tingkat_prestasi')->updateOrInsert(
                ['id_tingkat' => $row['id_tingkat']],
                ['nama_tingkat' => $row['nama_tingkat']]
            );
        }
        $this->command->info('✅ TingkatPrestasiSeeder selesai.');
    }
}
