<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class SeederCategoria extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'HIDRAULICA',]);
        Category::create(['name' => 'PARTE ELETRICA',]);
        Category::create(['name' => 'MOTOR',]);
        Category::create(['name' => 'FUNILARIA',]);
        Category::create(['name' => 'SUSPENSAO',]);
        Category::create(['name' => 'ACESSORIOS',]);
    }
}
