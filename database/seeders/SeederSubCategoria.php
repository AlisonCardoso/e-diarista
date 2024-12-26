<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\SubCategory;

class SeederSubCategoria extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subcategory::create(['name' => 'chicote eletrico', 'category_id' => '1']);
        Subcategory::create(['name' => 'lampada', 'category_id' => '1']);
        Subcategory::create(['name' => 'produto 3', 'category_id' => '1']);
        Subcategory::create(['name' => 'produto 4', 'category_id' => '2']);
        Subcategory::create(['name' => 'produto 5', 'category_id' => '2']);
        Subcategory::create(['name' => 'produto 6', 'category_id' => '3']);
        Subcategory::create(['name' => 'produto 7', 'category_id' => '3']);
        Subcategory::create(['name' => 'produto 8', 'category_id' => '4']);
        Subcategory::create(['name' => 'produto 9', 'category_id' => '5']);
    }
}
