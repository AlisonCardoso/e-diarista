<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\RegionalCommand;
use App\Models\SubCommand;



class CreateCompany extends Component


{
    public $regional_command;
    public $regional_command_id;
    public $sub_command_id;
    public $sub_commands;
    public $sub_command ;


    public function mount()
    {
        $this->regional_command =RegionalCommand::all();
        $this->sub_commands = collect();
    }

    public function filterSubCommandById()
    {
        //dd($this->regional_command);
        $this->sub_commands = $this->regional_command->find($this->regional_command_id)->sub_command;
    }




    public function render()
    {
        return view('livewire.create-company');
    }
}
