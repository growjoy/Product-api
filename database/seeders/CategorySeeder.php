<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'name' => 'Elektronik',
            'description' => 'Produk elektronik dan gadget'
        ]);

        Category::create([
            'name' => 'Fashion',
            'description'=> 'Pakaian dan aksesoris'
        ]);

        Category::create([
            'name' => 'Makanan',
            'description' => 'Makanan dan minuman'
        ]);
    }
}