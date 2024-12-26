<?php

namespace Database\Seeders;

use App\Models\RegionalCommand;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeederComandoRegional extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        RegionalCommand::create(['name' => '1º COMANDO REGIONAL DE POLICÍA MILITAR', 'slug' => '1º CRPM']);
        RegionalCommand::create(['name' => '2º COMANDO REGIONAL DE POLICÍA MILITAR', 'slug' => '2º CRPM']);
        RegionalCommand::create(['name' => '3º COMANDO REGIONAL DE POLICÍA MILITAR', 'slug' => '3º CRPM']);
        RegionalCommand::create(['name' => '4º COMANDO REGIONAL DE POLICÍA MILITAR', 'slug' => '4º CRPM']);
        RegionalCommand::create(['name' => '5º COMANDO REGIONAL DE POLICÍA MILITAR', 'slug' => '5º CRPM']);
        RegionalCommand::create(['name' => '6º COMANDO REGIONAL DE POLICÍA MILITAR', 'slug' => '6º CRPM']);
        RegionalCommand::create(['name' => 'COMANDO DE POLICIAMENTO ESPECIALIZADO', 'slug' => 'CPE']);
        RegionalCommand::create(['name' => 'COMANDO GERAL DE POLICÍA MILITAR', 'slug' => 'CME']);
    }
}
