<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use App\Models\SubCommand;
use App\Models\TypeVehicle;
use App\Models\SituationVehicle;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class VehicleSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Garantir que existam dados nas tabelas relacionadas antes de criar veículos
        $subCommands = SubCommand::all();
        $typeVehicles = TypeVehicle::all();
        $situationVehicles = SituationVehicle::all();

        if ($subCommands->isEmpty() || $typeVehicles->isEmpty() || $situationVehicles->isEmpty()) {
            $this->command->info('Por favor, insira dados nas tabelas sub_commands, type_vehicles e situation_vehicles antes de rodar este seeder.');
            return;
        }

        // Criando veículos fictícios
        for ($i = 0; $i < 20; $i++) {
            Vehicle::create([
                'sub_command_id' => $subCommands->random()->id,
                'type_vehicle_id' => $typeVehicles->random()->id,
                'situation_vehicle_id' => $situationVehicles->random()->id,
                'brand' => $faker->company,
                'model' => $faker->word,
                'prefix' => strtoupper($faker->lexify('???')) . rand(100, 999),
                'characterized' => $faker->boolean,
                'asset_number' => $faker->optional()->uuid,
                'odometer' => $faker->numerify('#####'),
                'plate' => strtoupper($faker->lexify('???')) . rand(1000, 9999),
                'year' => $faker->year(),
                'price' => $faker->randomFloat(2, 10000, 50000),  // Valor entre 10,000 e 50,000
            ]);
        }

        $this->command->info('Veículos gerados com sucesso!');
    }
}
