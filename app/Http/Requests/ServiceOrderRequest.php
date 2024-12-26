<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ServiceOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        // Autoriza todos os usuários (ajuste conforme necessário)
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
           // $validated['user_id'] = Auth::user();
            'user_id' => 'required|exists:users,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'workshop_id' => 'required|exists:workshops,id',
            'situation_id' => 'required|exists:situations,id',
            'service_date' => 'required|date',
            'labor_hourly_rate' => 'nullable|numeric',
            'labor_hours' => 'nullable|integer|min:0',
            'product_id' => 'required|array',
            'quantity' => 'required|array',
            'labor_total' => 'nullable|numeric',
            'order_total' => 'nullable|numeric',
            'total_service_order' => 'required|numeric',
            'product_price' => 'required|array',
            'description' => 'nullable',
           // 'product_id.*' => 'required|exists:products,id',
           // 'product_quantity.*' => 'required|integer|min:1',
           // 'product_price.*' => 'required|numeric|min:0',
        ];

    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'vehicle_id' => 'veículo',
            'workshop_id' => 'oficina',
            'situation_id' => 'situação',
            'service_date' => 'data do serviço',
            'labor_hourly_rate' => 'valor da hora de trabalho',
            'labor_hours' => 'número de horas de trabalho',
            'product_id' => 'produto',
            'product_quantity' => 'quantidade do produto',
            'product_price' => 'preço do produto',
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => Auth::id(), // Define o user_id como o ID do usuário autenticado
        ]);
    }

}
