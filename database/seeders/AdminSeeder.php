<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::insert([
            ['id_admin' => 'AD12345', 'nama_admin' => 'Falih', 'username' => 'falih1234_', 'password' => Hash::make('123456'), 'email' => 'admin@polije.id'],
            ['id_admin' => 'AD12346', 'nama_admin' => 'Admin 2', 'username' => 'admin2_', 'password' => Hash::make('123456'), 'email' => 'admin2@polije.id'], 
            ['id_admin' => 'AD12347', 'nama_admin' => 'Admin 3', 'username' => 'admin3_', 'password' => Hash::make('123456'), 'email' => 'admin3@polije.id'], 
        ]);
    }
}
