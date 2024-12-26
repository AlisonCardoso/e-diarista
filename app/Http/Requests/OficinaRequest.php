<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OficinaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $oficinaId = $this->route('oficina') ? $this->route('oficina')->id : null;

        return [
            // Regras de validação para Oficina
            'cnpj' => 'nullable|string|unique:oficinas,cnpj,' . $oficinaId,
            'razao_social' => 'nullable|string',
            'descricao_situacao_cadastral' => 'nullable|string',
            'cnae_fiscal_descricao' => 'nullable|string',
            'phone_number' => 'nullable|string',
            'email' => 'nullable|email',
            'responsavel' => 'nullable|string',

            // Regras de validação para Address
            'cep' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'neighborhood' => 'required|string',
            'street' => 'required|string',
            'number' => 'nullable|integer',
            'complement' => 'nullable|string',
        ];
    }
}
