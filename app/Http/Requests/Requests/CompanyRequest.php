<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'pelotao' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:companies,slug',
            'sub_command' => 'required|numeric|exists:sub_commands,id',
        ];
    }

    /**
     * Custom messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Campo nome é obrigatório!',
            'name.string' => 'O nome deve ser uma string.',
            'name.max' => 'O nome não pode ter mais que 255 caracteres.',
            'pelotao.string' => 'O pelotão deve ser uma string.',
            'pelotao.max' => 'O pelotão não pode ter mais que 255 caracteres.',
            'slug.unique' => 'Esse slug já está em uso.',
            'sub_command.required' => 'Campo sub comando é obrigatório!',
            'sub_command.exists' => 'O sub comando selecionado é inválido.',
        ];
    }
}
