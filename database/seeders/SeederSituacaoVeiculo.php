<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SituationVehicle;

class SeederSituacaoVeiculo extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // ['name', 'color', 'vehicle_id'];
      
    {
        if(!SituationVehicle::where('name', 'Ativo')->first())
        {
            SituationVehicle::create([
                'name' => 'Ativo',
                'color' => 'green-600',
            ]);
        }
        if(!SituationVehicle::where('name', 'Manutenção')->first()){
            SituationVehicle::create([
                'name' => 'Manutenção',
                'color' => 'yellow-600',
            ]);
        }
        if(!SituationVehicle::where('name', 'Baixado')->first()){
            SituationVehicle::create([
                'name' => 'Baixado',
                'color' => 'red-600',
            ]);
        }
        if(!SituationVehicle::where('name', 'Descarregado')->first()){
            SituationVehicle::create([
                'name' => 'Descarregado',
                'color' => 'gray-600', // sky-600
            ]);
        }
    }
    
}
}
