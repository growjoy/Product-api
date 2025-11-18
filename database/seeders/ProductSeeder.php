<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'category_id' => 1,
            'name' => 'Laptop ASUS',
            'description' => 'Laptop gaming dengan spesifikasi tinggi',
            'price' => 8500000,
            'stock' => 25
        ]);

        Product::create([
            'category_id' => 1,
            'name' => 'Mouse Wireless',
            'description' => 'Mouse wireless ergonomis',
            'price' => 150000,
            'stock' => 0
        ]);

        Product::create([
            'category_id' => 2,
            'name' => 'Kaos Polos',
            'description' => 'Kaos polos cotton combed',
            'price' => 75000,
            'stock' => 100
        ]);
    }
}