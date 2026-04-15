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
            'nama_mahasiswa' => 'Administrator',
            'email' => 'admin@polije.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Akun Mahasiswa 
        User::create([
            'username' => 'mhs_tester',
            'nama_mahasiswa' => 'Mahasiswa Contoh',
            'email' => 'NIM@polije.ac.id',
            'password' => Hash::make('E12345621'),
            'role' => 'mahasiswa',
            'nim' => 'E41234567',
            'jurusan' => 'Teknologi Informasi',
            'prodi' => 'Teknik Informatika',
            'angkatan' => 2024,
        ]);
    }
}