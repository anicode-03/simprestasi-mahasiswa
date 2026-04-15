<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
        ['nama_kategori' => 'Akademik'],
        ['nama_kategori' => 'Seni'],
        ['nama_kategori' => 'Olahraga'],
        ['nama_kategori' => 'Seni'],
        ['nama_kategori' => 'Organisasi'],
    ];

    foreach ($categories as $cat) {
        Category::create($cat);

    }
    }

}
