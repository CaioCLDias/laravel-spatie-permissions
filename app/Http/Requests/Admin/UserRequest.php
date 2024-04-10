<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\AppRequest;
use Illuminate\Validation\Rule;

class UserRequest extends AppRequest
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
            'active'=> 'nullable|numeric',
            'username' => ['required', 'string', Rule::unique('users')->ignore($this->id)],
            'password' => 'required|string|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'active.numeric'  => 'O campo ATIVO deve ser um número.',
            'username.required'  => 'O campo USUÁRIO é obrigatório.',
            'username.unique'  => 'Este USUÁRIO já está sendo utilizado.',
            'password.confirmed'  => 'As senhas não coicidem.',
            'password.required'  => 'É necessário informar uma senha.',
        ];
    }
}
