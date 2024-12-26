<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Vehicle;

class SearchVehicleByPlate extends Component
{
    public $vehicles = [];
    public $selectedVehicleId;
    public $vehicleDetails = [
        'brand' => '',
        'model' => '',
        'year' => '',
        'odometer' => '',
        'characterized' => '',
        // adicione outros campos conforme necessário
    ];

    public function mount()
    {
        // Carrega todos os veículos ao montar o componente
        $this->vehicles = Vehicle::all();
    }

    public function updatedSelectedVehicleId($value)
    {
        // Busca os detalhes do veículo selecionado
        $vehicle = Vehicle::find($value);

        if ($vehicle) {
            $this->vehicleDetails = [
                'brand' => $vehicle->brand,
                'model' => $vehicle->model,
                'year' => $vehicle->year,
                'odometer' => $vehicle->odometer,
                'characterized' => $vehicle->characterized,
                // Inclua outros atributos do veículo conforme necessário
            ];
        } else {
            $this->vehicleDetails = [
                'brand' => '',
                'model' => '',
                'year' => '',
                'odometer' => '',
                'characterized' => '',
            ];
        }
    }

    public function render()
    {
        return view('livewire.search-vehicle-by-plate');
    }
}
