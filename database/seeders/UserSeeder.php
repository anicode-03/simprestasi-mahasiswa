<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mahasiswa = [
            ['nim' => 'e41251122', 'name' => 'Fikiryah Imtyaz', 'angkatan' => 2025],
            ['nim' => 'e41251123', 'name' => 'Budi Santoso', 'angkatan' => 2024],
            ['nim' => 'e41251124', 'name' => 'Siti Aminah', 'angkatan' => 2023],
        ];
    
    foreach ($mahasiswa as $mhs) {
        User::firstOrCreate(
            ['nim' => $mhs['nim']],
            [
            'role' => 'mahasiswa',
            'name'=> $mhs['name'],
            'email' => "{$mhs['nim']}@student.polije.ac.id",
            'password' => Hash::make('e41251122'),
            'jurusan'=> 'Teknologi Informasi',
            'prodi' => 'Teknik Informatika',
            'angkatan' => $mhs['angkatan'],
            'no_hp' => '081234567820',
        ]
    );

        User::firstOrCreate(
            ['email' => 'admin@polije.com'],
            [
            'role' => 'admin',
            'name' => 'Administrator',
            'password' => Hash::make('admin123'),
            'jurusan' => null,
            'prodi' => null,
            'angkatan' => null,
            'no_hp' => '081234567891',
            ]
        );
    }
    $this->command->info('✅ UserSeeder selesai.');
}

}