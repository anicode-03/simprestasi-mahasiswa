<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Faker\Factory as Faker;

class PrestasiSeeder extends Seeder {

    public function run(): void {

        $faker = Faker::create('id_ID');

        $userTable = (new User())->getTable();
        $userId = DB::table($userTable)->pluck('id')->toArray();

        $kategoriId = DB::table('kategori')->pluck('id_kategori')->toArray();
        $tingkatId = DB::table('tingkat_prestasi')->pluck('id_tingkat')->toArray();

        if (empty($userId)) {
            $this->command->error("⚠️ Tabel '{$userTable}' terdeteksi kosong. Menggunakan fallback ID 1.");
            $userId = [1];
        }

        if (empty($kategoriId)) {
            $this->command->error("⚠️ Tabel 'kategori' kosong. Menggunakan fallback KAT0900.");
            $kategoriId = ['KAT0900'];
        }

        if (empty($tingkatId)) {
            $this->command->error("⚠️ Tabel 'tingkat_prestasi' kosong. Menggunakan fallback T0011.");
            $tingkatId = ['T0011'];
        }

        $data = [];
        for ($i = 0; $i < 30; $i++) {
            $data[] =[
                'id_prestasi'       => 'PRES-' . strtoupper($faker->unique()->numerify('####')),
                'users_id'          => $faker->randomElement($userId),
                'id_kategori'       => $faker->randomElement($kategoriId),
                'id_tingkat'        => $faker->randomElement($tingkatId),
                'nama_prestasi'     => $faker->sentence(4),
                'peringkat'         => $faker->numberBetween(1, 5), 
                'penyelenggara'     => $faker->company . ' / ' . $faker->words(2, true),
                'lokasi'            => $faker->city,
                'tanggal_kegiatan'  => $faker->dateTimeBetween('-3 years', 'now')->format('Y-m-d'),
                'deskripsi'         => $faker->optional(0.8)->paragraph(),
                'created_at'        => now(),
                'updated_at'        => now(),
            ];
        
        }

        DB::table('prestasi')->insert($data);
        $this->command->info('PrestasiSeeder selesai!');

    }
}




?>