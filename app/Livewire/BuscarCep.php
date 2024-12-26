<?php

namespace App\Livewire;

use App\Models\Address;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

class BuscarCep extends Component
{
    protected array $rules = [
        'cep' => ['required'],
        'state' => ['required'],
        'city' => ['required'],
        'neighborhood' => ['required'],
        'street' => ['required']
    ];
    protected array $messages = [
        'cep.required' => 'O campo CEP é obrigatório.',
        'state.required' => 'O campo ESTADO é obrigatório.',
        'city.required' => 'O campo CIDADE é obrigatório.',
        'neighborhood.required' => 'O campo BAIRRO é obrigatório.',
        'street.required' => 'O campo RUA é obrigatório.',
    ];

    public string $cep = '';
    public string $street = '';
    public string $neighborhood = '';
    public string $city = '';
    public string $state = '';

    public function updatedCep (string $value) {
        // $response = Http::get("https://brasilapi.com.br/api/cep/v1/{$value}")->json();
        $response = Http::withOptions(['verify' => false])->get("https://brasilapi.com.br/api/cep/v1/{$value}")->json();

    if ($response && isset($response['cep'])) {
        $this->cep = $response['cep'];
        $this->state = $response['state'];
        $this->city = $response['city'];
        $this->neighborhood = $response['neighborhood'];
        $this->street = $response['street'];
    } else {
        // Lógica para lidar com uma resposta inválida, se necessário
        session()->flash('error', 'CEP não encontrado ou resposta inválida da API.');
    }
    }

    
    public function save() {
        $this->validate();

        Address::updateOrCreate(
            [
                'cep' => $this->cep,
            ],
            [
                'state' => $this->state,
                'city' => $this->city,
                'neighborhood' => $this->neighborhood,
                'street' => $this->street
            ]);
        $this->reset();
    }


    public function render()
    {
        return view('livewire.buscar-cep');
    }
}

