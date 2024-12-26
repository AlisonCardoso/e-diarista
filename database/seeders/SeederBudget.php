<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Budget;

class SeederBudget extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {



        Budget::create([

            'vehicle_id' => 1,
            'total_labor'=> 1,
            'total_products'=> 280,
            'total_amount'=> 580,
            'situation_id' => 1,

        ]);
    }
}
