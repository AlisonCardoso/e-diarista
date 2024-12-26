<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubCommand;

class SeederBAtalhao extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubCommand::create(['name' => '1º BATALHÃO DE POLICÍA MILITAR', 'slug' => '1º BPM','regional_command_id'=>'4', 'image' =>'img/brasao/logo_1bpm.png']);
        SubCommand::create(['name' => '2º BATALHÃO DE POLICÍA MILITAR', 'slug' => '2º BPM','regional_command_id'=>'2', 'image' =>'img/brasao/logo2bpm.png']);
        SubCommand::create(['name' => '3º BATALHÃO DE POLICÍA MILITAR', 'slug' => '3º BPM','regional_command_id'=>'5']);
        SubCommand::create(['name' => '4º BATALHÃO DE POLICÍA MILITAR', 'slug' => '4º BPM','regional_command_id'=>'3']);
        SubCommand::create(['name' => '5º BATALHÃO DE POLICÍA MILITAR', 'slug' => '5º BPM','regional_command_id'=>'2']);
        SubCommand::create(['name' => '6º BATALHÃO DE POLICÍA MILITAR', 'slug' => '6º BPM','regional_command_id'=>'5']);
        SubCommand::create(['name' => '7º BATALHÃO DE POLICÍA MILITAR', 'slug' => '7º BPM','regional_command_id'=>'3']);
        SubCommand::create(['name' => '8º BATALHÃO DE POLICÍA MILITAR', 'slug' => '8º BPM','regional_command_id'=>'3']);
        SubCommand::create(['name' => '9º BATALHÃO DE POLICÍA MILITAR', 'slug' => '9º BPM','regional_command_id'=>'6']);
        SubCommand::create(['name' => '10º BATALHÃO DE POLICÍA MILITAR', 'slug' => '10º BPM','regional_command_id'=>'2']);
        SubCommand::create(['name' => '11º BATALHÃO DE POLICÍA MILITAR', 'slug' => '11º BPM','regional_command_id'=>'3']);
        SubCommand::create(['name' => '12º BATALHÃO DE POLICÍA MILITAR', 'slug' => '12º BPM','regional_command_id'=>'1']);
        SubCommand::create(['name' => '13º BATALHÃO DE POLICÍA MILITAR', 'slug' => '13º BPM','regional_command_id'=>'1']);
        SubCommand::create(['name' => '14º BATALHÃO DE POLICÍA MILITAR', 'slug' => '14º BPM','regional_command_id'=>'5']);
        SubCommand::create(['name' => '15º BATALHÃO DE POLICÍA MILITAR', 'slug' => '15º BPM','regional_command_id'=>'2']);
        SubCommand::create(['name' => '16º BATALHÃO DE POLICÍA MILITAR', 'slug' => '16º BPM','regional_command_id'=>'4']);
        SubCommand::create(['name' => '17º BATALHÃO DE POLICÍA MILITAR', 'slug' => '17º BPM','regional_command_id'=>'6']);
        SubCommand::create(['name' => '18º BATALHÃO DE POLICÍA MILITAR', 'slug' => '18º BPM','regional_command_id'=>'2']);
        SubCommand::create(['name' => '19º BATALHÃO DE POLICÍA MILITAR', 'slug' => '19º BPM','regional_command_id'=>'5']);
        SubCommand::create(['name' => '20º BATALHÃO DE POLICÍA MILITAR', 'slug' => '20º BPM','regional_command_id'=>'1']);
        SubCommand::create(['name' => '21º BATALHÃO DE POLICÍA MILITAR', 'slug' => '21º BPM','regional_command_id'=>'5']);
        SubCommand::create(['name' => '22º BATALHÃO DE POLICÍA MILITAR', 'slug' => '22º BPM','regional_command_id'=>'6']);
        SubCommand::create(['name' => '23º BATALHÃO DE POLICÍA MILITAR', 'slug' => '23º BPM','regional_command_id'=>'1','image' => 'img/brasao/logo_23bpm.jpg']);
        SubCommand::create(['name' => '25º BATALHÃO DE POLICÍA MILITAR', 'slug' => '25º BPM','regional_command_id'=>'3']);
        SubCommand::create(['name' => '26º BATALHÃO DE POLICÍA MILITAR', 'slug' => '26º BPM','regional_command_id'=>'4']);
        SubCommand::create(['name' => '27º BATALHÃO DE POLICÍA MILITAR', 'slug' => '27º BPM','regional_command_id'=>'4', 'image' => 'img/brasao/logo_27bpm.png']);
        SubCommand::create(['name' => '28º BATALHÃO DE POLICÍA MILITAR', 'slug' => '28º BPM','regional_command_id'=>'6']);
        SubCommand::create(['name' => '29º BATALHÃO DE POLICÍA MILITAR', 'slug' => '29º BPM','regional_command_id'=>'6']);
        SubCommand::create(['name' => '30º BATALHÃO DE POLICÍA MILITAR', 'slug' => '30º BPM','regional_command_id'=>'2']);
        SubCommand::create(['name' => '31º BATALHÃO DE POLICÍA MILITAR', 'slug' => '31º BPM','regional_command_id'=>'5']);
        SubCommand::create(['name' => '32º BATALHÃO DE POLICÍA MILITAR', 'slug' => '32º BPM','regional_command_id'=>'3']);

        SubCommand::create(['name' => '3º COMPANHIA INDEPENDENTE DE POLICÍA MILITAR', 'slug' => '3º CIPM','regional_command_id'=>'3']);
        SubCommand::create(['name' => '5º COMPANHIA INDEPENDENTE DE POLICÍA MILITAR', 'slug' => '5º CIPM','regional_command_id'=>'3']);
        SubCommand::create(['name' => '6º COMPANHIA INDEPENDENTE DE POLICÍA MILITAR', 'slug' => '6º CIPM','regional_command_id'=>'2']);
        SubCommand::create(['name' => '7º COMPANHIA INDEPENDENTE DE POLICÍA MILITAR', 'slug' => '7º CIPM','regional_command_id'=>'2']);
        SubCommand::create(['name' => '8 COMPANHIA INDEPENDENTE DE POLICÍA MILITAR', 'slug' => '8 CIPM','regional_command_id'=>'4']);
        SubCommand::create(['name' => '9º COMPANHIA INDEPENDENTE DE POLICÍA MILITAR', 'slug' => '9º CIPM','regional_command_id'=>'3']);
        SubCommand::create(['name' => '10º COMPANHIA INDEPENDENTE DE POLICÍA MILITAR', 'slug' => '10º CIPM','regional_command_id'=>'4']);
        SubCommand::create(['name' => '11º COMPANHIA INDEPENDENTE DE POLICÍA MILITAR', 'slug' => '11º CIPM','regional_command_id'=>'2']);
        SubCommand::create(['name' => '12º COMPANHIA INDEPENDENTE DE POLICÍA MILITAR', 'slug' => '11º CIPM','regional_command_id'=>'5']);

        SubCommand::create(['name' => 'BATALHÃO DE POLICÍA MONTADA', 'slug' => 'BPMom','regional_command_id'=>'7']);
       
        SubCommand::create(['name' => 'BATALHÃO DE POLICÍA DE TRANSITO', 'slug' => 'BPTran','regional_command_id'=>'7', 'image' => 'img/brasao/logo_bptran.png']);
        SubCommand::create([ 'name' => 'BATALHÃO DE POLICÍA RODOVIÁRIA', 'slug' => 'BPRv', 'regional_command_id'=>'7', 'image' =>'img/brasao/logo_bprv.png' ]);

        SubCommand::create(['name' => 'BATALHÃO DE POLICÍA AMBIENTAL', 'slug' => 'BPAmb','regional_command_id'=>'7', 'image' =>'img/brasao/logo_bpec.png']);
        SubCommand::create(['name' => 'BATALHÃO DE POLICÍA ESCOLAR COMUNITARIA', 'slug' => 'BPEC','regional_command_id'=>'7', 'image' =>'img/brasao/logo_bpamb.jpg']);

        SubCommand::create(['name' => 'BATALHÃO DE OPERAÇOES POLICIAIS ESPECIAL', 'slug' => 'BOPE','regional_command_id'=>'8']);











    }
}
