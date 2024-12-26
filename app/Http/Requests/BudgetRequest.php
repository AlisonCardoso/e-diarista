<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BudgetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Você pode personalizar a lógica de autorização,
        // mas por enquanto deixamos como true (permitido para todos)
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'vehicle_id' => 'required|exists:vehicles,id',
        'workshop_id' => 'required|exists:workshops,id',
        'situation_id' => 'required|exists:situations,id',
        'service_date' => 'required|date',
        'labor_hourly_rate' => 'nullable|numeric|min:0',
        'labor_hours' => 'nullable|integer|min:1',
        'products.*.id' => 'required|exists:products,id',
        'products.*.quantity' => 'required|integer|min:1',
        'products.*.price' => 'required|numeric|min:0',
        ];
    }

    /**
     * Get the custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'vehicle_id.required' => 'O campo veículo é obrigatório.',
            'workshop_id.required' => 'O campo oficina é obrigatório.',
            'situation_id.required' => 'O campo situação é obrigatório.',
            'service_date.required' => 'A data do serviço é obrigatória.',
            'products.*.id.required' => 'O campo produto é obrigatório.',
            'products.*.quantity.required' => 'A quantidade do produto é obrigatória.',
            'products.*.price.required' => 'O preço do produto é obrigatório.',
        ];
    }
}
