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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           'sub_command_id' => 'required|string|max:150',
            'type_vehicle_id' => 'required|string|max:55',
            'situation_vehicle_id' => 'required|string|max:55',
            'brand' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'asset_number'=> 'required|string|max:100',
            'plate' => 'required|string|max:10|unique:vehicles,plate' ,
            'prefix' => 'required|string|max:10|unique:vehicles,prefix', 
            'year' => 'required|digits:4|integer|min:1900|max:' . (date('Y')),
            'odometer' => 'required|integer',
            'characterized' => 'required|boolean',
            'active' => 'required|boolean',
            'price' => 'required|numeric|min:0',
        ];
    }
}
