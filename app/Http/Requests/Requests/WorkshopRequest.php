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
            'cnpj' => 'required|string|max:14|unique:workshops,cnpj,' . $this->route('workshop'),
            'razao_social' => 'required|string|max:255',
            'cnae_fiscal_descricao' => 'nullable|string|max:255',
            'descricao_situacao_cadastral' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'responsavel' => 'nullable|string|max:255',
            'phone_number' => 'required|string|max:15',
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
        return[
            'cnpj.required' => 'O CNPJ é obrigatório.',
            'cnpj.unique' => 'Esse CNPJ já está cadastrado.',
            'razao_social.required' => 'A razão social é obrigatória.',
            'descricao_situacao_cadastral.required' => 'Campo situação é obrigatório!',
            'cnae_fiscal_descricao.required' => 'Campo nome fantasia é obrigatório!',
            'email.nullable' => 'O e-mail é obrigatório.',
            'email.email' => 'O e-mail deve ser um endereço de e-mail válido.',
             'responsavel.nullable' => 'O nome do responsável é obrigatório.',
            'phone_number.nullable' => 'O telefone é obrigatório.',
            'cep.required' => 'O CEP é obrigatório.',
            'state.required' => 'O estado é obrigatório.',
            'city.required' => 'A cidade é obrigatória.',
            'neighborhood.required' => 'O bairro é obrigatório.',
            'street.required' => 'A rua é obrigatória.',
           
           
        ];
    }
}