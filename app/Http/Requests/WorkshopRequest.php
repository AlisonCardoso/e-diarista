<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkshopRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cnpj' => 'nullable|string|max:21|unique:workshops,cnpj,' . $this->route('workshop'),
            'razao_social' => 'nullable|string|max:255',
            'cnae_fiscal_descricao' => 'nullable|string|max:255',
            'descricao_situacao_cadastral' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'responsavel' => 'nullable|string|max:255', // Alterado para 'nullable'
            'phone_number' => 'nullable|string|max:15',
            'cep' => 'required|string|max:10',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'neighborhood' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'number' => 'nullable|string|max:10',
            'complement' => 'nullable|string|max:255',

        ];
    }

    public function messages(): array
    {
        return [
            'cnpj.unique' => 'Esse CNPJ já está cadastrado.',
            'email.email' => 'O e-mail deve ser um endereço de e-mail válido.',
            'cep.required' => 'O CEP é obrigatório.',
            'state.required' => 'O estado é obrigatório.',
            'city.required' => 'A cidade é obrigatória.',
            'neighborhood.required' => 'O bairro é obrigatório.',
            'street.required' => 'A rua é obrigatória.',
        ];
    }
}
