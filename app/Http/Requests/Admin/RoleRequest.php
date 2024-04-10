<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O Nome do Perfil é obrigatório',
            'permissions.required' => 'Permissões é obrigatório'
        ];
    }


}
