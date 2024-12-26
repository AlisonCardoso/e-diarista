<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;



class SeederCompanies extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void

    {
        Company::create(['name' => '1ª COMPANHIA DE POLICÍA RODOVIÁRIA', 'slug' => '1ªCIA/BPRv','sub_command_id'=>'43']);
        Company::create(['name' => '1ª COMPANHIA DE POLICÍA RODOVIÁRIA', 'slug' => '1ªCIA/BPRv','pelotao' => 'BPRv/1ªCIA/2ºPel-PRv-Lapa','sub_command_id'=>'43']);
        Company::create(['name' => '1ª COMPANHIA DE POLICÍA RODOVIÁRIA', 'slug' => '1ªCIA/BPRv','pelotao' => 'BPRv/1ªCIA/2ºPel-PRv-São Mateus do Sul','sub_command_id'=>'43']);
        Company::create(['name' => '1ª COMPANHIA DE POLICÍA RODOVIÁRIA', 'slug' => '6ªCIA/BPRv','pelotao' => 'BPRv/6ªCIA/2ºPel-PRv-União da Vitória','sub_command_id'=>'43']);
    }
}
