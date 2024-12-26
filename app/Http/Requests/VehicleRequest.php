<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleRequest extends FormRequest
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
            'sub_command_id' => 'required|string|max:8',
            'type_vehicle_id' => 'required|string|max:8',
            'situation_vehicle_id' => 'required|string|max:8',
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'asset_number' => 'nullable|string|max:20',
            'plate' => [
                'required',
                'string',
                'max:10',
                'unique:vehicles,plate,' . optional($this->route('vehicle'))->id,  // Ajuste para permitir atualização
            ],
            'prefix' => [
                'required',
                'string',
                'max:10',
                'unique:vehicles,prefix,' . optional($this->route('vehicle'))->id, // Ajuste para permitir atualização
            ],
            'year' => 'required|digits:4|integer|min:2010|max:' . date('Y'),
            'odometer' => 'nullable|integer',
            'characterized' => 'required|boolean', // O valor de characterized será 1 ou 0
            'price' => 'required|numeric|min:0',
        ];
    }

    /**
     * Custom validation error messages.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'sub_command_id.required' => 'O campo "Subcomando" é obrigatório.',
            'type_vehicle_id.required' => 'O campo "Tipo de veículo" é obrigatório.',
            'situation_vehicle_id.required' => 'O campo "Situação do veículo" é obrigatório.',
            'situation_vehicle_id.string' => 'O campo "Situação do veículo" deve ser uma string.',
            'situation_vehicle_id.max' => 'O campo "Situação do veículo" deve ter no máximo 55 caracteres.',

            'brand.required' => 'A marca do veículo é obrigatória.',
            'brand.string' => 'O campo "Marca" deve ser uma string.',
            'brand.max' => 'O campo "Marca" deve ter no máximo 100 caracteres.',

            'model.required' => 'O modelo do veículo é obrigatório.',
            'model.string' => 'O campo "Modelo" deve ser uma string.',
            'model.max' => 'O campo "Modelo" deve ter no máximo 100 caracteres.',

            'asset_number.string' => 'O campo "Número de patrimônio" deve ser uma string.',
            'asset_number.max' => 'O campo "Número de patrimônio" deve ter no máximo 100 caracteres.',

            'plate.required' => 'A placa do veículo é obrigatória.',
            'plate.unique' => 'Já existe um veículo registrado com esta placa.',

            'prefix.required' => 'O prefixo do veículo é obrigatório.',
            'prefix.string' => 'O campo "Prefixo" deve ser uma string.',
            'prefix.max' => 'O prefixo do veículo deve ter no máximo 10 caracteres.',
            'prefix.unique' => 'Já existe um veículo registrado com este prefixo.',

            'year.required' => 'O ano do veículo é obrigatório.',
            'year.integer' => 'O ano do veículo deve ser um número inteiro.',
            'year.digits' => 'O ano do veículo deve ter 4 dígitos.',
            'year.min' => 'O ano do veículo não pode ser anterior a 2010.',
            'year.max' => 'O ano do veículo não pode ser superior ao ano atual.',

            'odometer.integer' => 'O odômetro deve ser um número inteiro.',

            'characterized.required' => 'O campo "Caracterizado" é obrigatório.',
            'characterized.boolean' => 'O campo "Caracterizado" deve ser verdadeiro ou falso.',

            'price.required' => 'O preço do veículo é obrigatório.',
            'price.numeric' => 'O campo "Preço" deve ser numérico.',
            'price.min' => 'O preço do veículo não pode ser menor que 0.',
        ];
    }

    /**
     * Prepare data for validation (modify request data before validation).
     */
    public function prepareForValidation()
    {
        // O campo 'characterized' será tratado como um valor booleano (1 ou 0)
        $this->merge([
            'characterized' => $this->has('characterized') ? 1 : 0,
        ]);
    }
}
