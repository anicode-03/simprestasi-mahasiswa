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
        ['id_kategori' => 'KTI21', 'nama_kategori' => 'Akademik'],
        ['id_kategori' => 'KTI22', 'nama_kategori' => 'Seni'],
        ['id_kategori' => 'KTI23', 'nama_kategori' => 'Olahraga'],
        ['id_kategori' => 'KTI24', 'nama_kategori' => 'Organisasi'],
    ];

    foreach ($categories as $cat) {
        Category::create($cat);

    }
    }

}
