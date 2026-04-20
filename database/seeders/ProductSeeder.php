<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create(['name' => 'Royal Canin Adult Dog Food', 'description' => 'Makanan Anjing', 'price' => 850.0000]);
        Product::create(['name' => 'Whiskas Adult Cat Food Tuna', 'description' => 'Makanan Kucing', 'price' => 125.000]);
        Product::create(['name' => 'Mainan Bola Karet untuk Anjing', 'description' => 'Mainan', 'price' => 45.000]);
    }
}
