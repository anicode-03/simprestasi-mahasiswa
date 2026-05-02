<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Simprestasi',
            'email' => 'admin@polije.id',
            'password' => Hash::make('AdminSecure123!'),
            'role' => 'admin',
        ]);

        

        $this->command->info('Admin berhasil dibuat!');
    }
}
