<?php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\RegionalCommand;
use App\Models\SubCommand;

class ComandoSelect extends Component
{
    public $regional_commandId;
    public $sub_command_id;
    public $sub_commands = [];

    public function render()
    {
        // Supondo que você tenha um modelo RegionalCommand
        $regional_commands = RegionalCommand::all();

        return view('livewire.comando-select', [
            'regional_commands' => $regional_commands,
            'sub_commands' => $this->sub_commands,
        ]);
    }

    public function filterSubCommandById()
    {
        // Aqui você filtra os sub-comandos com base no comando regional selecionado
        $this->sub_commands = SubCommand::where('regional_command_id', $this->regional_commandId)->get();
    }
}


