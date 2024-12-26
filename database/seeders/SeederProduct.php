<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class SeederProduct extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Product::create(['name' => 'Óleo Lubrificante', 'price' => 50.00, 'description' => 'Óleo 5W-30', 'stock' => 100, 'sub_category_id' => 1, 'created_at' => now(), 'updated_at' => now()]);
        Product::create(['name' => 'Filtro de Óleo', 'price' => 30.00, 'stock' => 50, 'sub_category_id' => 1, 'created_at' => now(), 'updated_at' => now()]);
        Product::create(['name' => 'Pneu', 'price' => 300.00, 'stock' => 20, 'sub_category_id' => 2, 'created_at' => now(), 'updated_at' => now()]);
    }
}
