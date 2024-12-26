<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ServiceOrder;

class SeederServiceOrder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {


        ServiceOrder::create([
       'budget_id' => 1,
        'workshop_id'=>1,
        'situation_id' =>1,
       'service_date' => now(),
        'labor_hourly_rate'=> 1, // Valor por hora da mão de obra
        'labor_hours'=> 1,  // Duração total da mão de obra em horas
       'labor_total' =>1, ]);
    }
}
