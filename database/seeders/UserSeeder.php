<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. ADMIN
        User::create([
            'name' => 'Falih Rahmatullah',
            'email' => 'admin@polije.id',
            'password' => Hash::make('123456'),
            'role' => 'admin',
            'nim' => null, 'prodi' => null, 'jurusan' => null, 'angkatan' => null, 'no_hp' => '081234567890'
        ]);

        // 2. MAHASISWA 1
        User::create([
            'name' => 'Ani Rizqi Ziarotus S.',
            'email' => 'e41251131@student.polije.ac.id',
            'password' => Hash::make('123456'),
            'role' => 'mahasiswa',
            'nim' => 'E41251131', 'prodi' => 'TIF', 'jurusan' => 'TI', 'angkatan' => 2025, 'no_hp' => '081453765423'
        ]);

        // 3. MAHASISWA 2
        User::create([
            'name' => 'Fikriyah Imtyaz',
            'email' => 'e41251122@student.polije.ac.id',
            'password' => Hash::make('123456'),
            'role' => 'mahasiswa',
            'nim' => 'E41251122', 'prodi' => 'TIF', 'jurusan' => 'TI', 'angkatan' => 2025, 'no_hp' => '081453786564'
        ]);

        // 4. MAHASISWA 3
        User::create([
            'name' => 'Erix Agung Wibowo',
            'email' => 'e41251146@student.polije.ac.id',
            'password' => Hash::make('123456'),
            'role' => 'mahasiswa',
            'nim' => 'E41251146', 'prodi' => 'TIF', 'jurusan' => 'TI', 'angkatan' => 2025, 'no_hp' => '081436759876'
        ]);
    }
}