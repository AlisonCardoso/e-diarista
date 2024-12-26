<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class SeederService extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Service::create([
            'name' => 'Troca de Óleo',
            'price' => 100.00,
            'description' => 'Troca de óleo completo',
            'duration' => 2,
           ]);


        Service::create([
            'name' => 'Alinhamento',
            'price' => 80.00,
            'description' => 'Alinhamento das rodas completo',
            'duration' => 1,  ]);
    }
}
