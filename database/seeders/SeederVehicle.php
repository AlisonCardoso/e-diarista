<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vehicle;
use Faker\Factory as Faker;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Usando o Faker para gerar dados fictícios
        $faker = Faker::create();

        // Supondo que as tabelas relacionadas (sub_commands, type_vehicles, situation_vehicles) já existam
        $subCommandIds = DB::table('sub_commands')->pluck('id')->toArray();
        $typeVehicleIds = DB::table('type_vehicles')->pluck('id')->toArray();
        $situationVehicleIds = DB::table('situation_vehicles')->pluck('id')->toArray();

        // Gerar dados para 10 veículos
        for ($i = 0; $i < 10; $i++) {
            DB::table('vehicles')->insert([
                'sub_command_id' => $faker->randomElement($subCommandIds),
                'type_vehicle_id' => $faker->randomElement($typeVehicleIds),
                'situation_vehicle_id' => $faker->randomElement($situationVehicleIds),
                'brand' => $faker->company, // Marca
                'model' => $faker->word, // Modelo
                'prefix' => $faker->unique()->word, // Prefixo único
                'characterized' => $faker->boolean(80), // Veículo caracterizado com 80% de chance de ser true
                'asset_number' => $faker->optional()->word, // Número de patrimônio (opcional)
                'odometer' => $faker->numberBetween(1000, 100000), // Hodômetro
                'plate' => $faker->unique()->bothify('???-####'), // Placa única
                'year' => $faker->year(), // Ano de fabricação
                'price' => $faker->randomFloat(2, 20000, 50000), // Preço entre 20.000 e 50.000
                'image' => $faker->imageUrl(), // URL da imagem
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}