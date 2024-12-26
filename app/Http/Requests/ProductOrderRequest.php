<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductOrderRequest extends FormRequest
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
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'product_price' => 'required|numeric|min:0',
        ];
    }
    public function messages(): array
    {
        return [
            'product_id.required' => 'um produto é obrigatório.',
            'quantity.required' => 'a quantidade é obrigatório.',
            'price.required' => 'o preço é obrigatório.',
        ];
    }
}
