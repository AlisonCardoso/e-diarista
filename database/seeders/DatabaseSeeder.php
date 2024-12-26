<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\RegionalCommand;
use App\Models\SubCommand;
use App\Models\Company;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\TypeVehicle;
use App\Models\Vehicle;
use App\Models\SituationVehicle;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    // public function run(): void
    // {
    //     // User::factory(10)->create();

    //     User::factory()->create([
    //         'name' => 'Test User',
    //         'email' => 'test@example.com',
    //     ]);
    // }
    // public function run()
    // {
    //     $this->call(AdminUserSeeder::class);
    // }
    public function run()
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call(AdminUserSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(SeederComandoRegional::class);
        $this->call(SeederBatalhao::class);
        $this->call(SeederCompanies::class);
        $this->call(SeederCategoria::class);
        $this->call(seederSubcategoria::class);
        $this->call(SeederSituation::class);
        $this->call(SeederProduct::class);
        $this->call(SeederService::class);
        $this->call(SeederSituacaoVeiculo::class);
        $this->call(Seedertipoveiculo::class);
        $this->call(VehicleSeeder::class);



    }


}
