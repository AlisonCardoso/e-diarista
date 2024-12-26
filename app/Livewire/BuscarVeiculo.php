<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Vehicle;

class BuscarVeiculo extends Component
{
    public $vehicles;
    public $selectedVehicleId;
    public $vehicleDetails = [];

    public function mount()
    {
        // Carregar todos os veículos do banco de dados
        $this->vehicles = Vehicle::all();
    }

    public function updatedSelectedVehicleId($vehicleId)
    {
        // Obter os detalhes do veículo selecionado
        $this->vehicleDetails = Vehicle::find($vehicleId) ? Vehicle::find($vehicleId)->toArray() : [];
    }
    public function render()
    {
        return view('livewire.buscar-veiculo');
    }
}
