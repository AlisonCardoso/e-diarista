<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeederSituation extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $situations = [
            ['name' => 'pending', 'color' => 'yellow-400', 'description' => 'Aguardando', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'approved',  'color' => 'green-500','description' => 'Aprovado', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'in-progress', 'color' => 'gray-400', 'description' => 'Em andamento', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'completed',  'color' => 'blue-500','description' => 'Concluído', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'rejected',  'color' => 'red-500','description' => 'Cancelado', 'created_at' => now(), 'updated_at' => now()],
            ];

        DB::table('situations')->insert($situations);

    
    }
}
