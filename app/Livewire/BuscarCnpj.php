<?php

namespace App\Livewire;

use App\Models\Workshop;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

class BuscarCnpj extends Component
{
    public string $cnpj = '';
    public string $razao_social = '';
    public string $descricao_situacao_cadastral = '';
    public string $cnae_fiscal_descricao = '';

    protected array $rules = [
        'cnpj' => ['required', 'regex:/^\d{14}$/'],  // Garante que o CNPJ tenha 14 dígitos
        'razao_social' => ['nullable', 'string'],
        'descricao_situacao_cadastral' => ['nullable', 'string'],
        'cnae_fiscal_descricao' => ['nullable', 'string'],
    ];

    public function updatedCnpj(string $value)
    {
        // Realiza a requisição para buscar o CNPJ na API BrasilAPI
        $response = Http::withOptions(['verify' => false])
            ->get("https://brasilapi.com.br/api/cnpj/v1/{$value}")
            ->json();

        if ($response && isset($response['cnpj'])) {
            $this->cnpj = $response['cnpj'];
            $this->razao_social = $response['razao_social'] ?? '';
            $this->descricao_situacao_cadastral = $response['descricao_situacao_cadastral'] ?? '';
            $this->cnae_fiscal_descricao = $response['cnae_fiscal_descricao'] ?? '';
        } else {
            session()->flash('error', 'CNPJ não encontrado ou resposta inválida da API.');
        }
    }

    public function save()
    {
        $this->validate();

        Workshop::updateOrCreate(
            [
                'cnpj' => $this->cnpj,
            ],
            [
                'razao_social' => $this->razao_social,
                'descricao_situacao_cadastral' => $this->descricao_situacao_cadastral,
                'cnae_fiscal_descricao' => $this->cnae_fiscal_descricao
            ]
        );

        session()->flash('success', 'Oficina cadastrada/atualizada com sucesso.');
        $this->reset(['cnpj', 'razao_social', 'descricao_situacao_cadastral', 'cnae_fiscal_descricao']);
    }

    public function render()
    {
        return view('livewire.buscar-cnpj');
    }
}
