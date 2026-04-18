<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Admin
        User::create([
            'username' => 'admin_simpresma',
            'nama_user' => 'Administrator',
            'email' => 'admin@polije.ac.id',
            'password' => bcrypt('password123'),
            'role' => 'admin',
            'id_admin' => 'AD001',
        ]);

        // Akun Mahasiswa 
        User::create([
            'username' => 'fikriyah',
            'nama_user' => 'Fikriyah Imtyaz',
            'email' => 'e41251122@student.polije.ac.id',
            'password' => bcrypt('e41251122'),
            'role' => 'mahasiswa',
            'nim' => 'E41234567',
            'jurusan' => 'Teknologi Informasi',
            'prodi' => 'Teknik Informatika',
            'angkatan' => 2025,
            'no_hp' => '087872550004'
        ]);
    }
}