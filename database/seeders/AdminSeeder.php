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
        User::updateOrCreate(
            ['email' => 'admin@polije.ac.id'],
            [
            'name' => 'Admin Simprestasi',
            'email' => 'admin@polije.id',
            'password' => Hash::make('AdminSecure123!'),
            'role' => 'admin',
            'no_hp' => '09894658734',
        ]);

        

        $this->command->info('AdminSeeder selesai!');
    }
}
