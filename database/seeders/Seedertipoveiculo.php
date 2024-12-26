<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TypeVehicle;

class Seedertipoveiculo extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeVehicle::create(['type' => 'GUINCHO']);
        TypeVehicle::create(['type' => 'AUTOMOVEL']);
        TypeVehicle::create(['type' => 'MOTOCICLETA']);
        TypeVehicle::create(['type' => 'ONIBUS']);
    }
}
