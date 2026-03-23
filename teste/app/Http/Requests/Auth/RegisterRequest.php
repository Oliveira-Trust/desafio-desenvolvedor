<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
        ];
    }

    public function messages() : array {
        return [
            'name.required' => 'Nome é obrigatório.',
            'name.max' => 'Nome deve ter no máximo 255 caracteres.',
            'email.required' => 'E-mail obrigatório.',
            'email.email' => 'Deve ser um e-mail válido.',
            'password.required' => 'Senha é obrigatório.',
            'password.min' => 'Senha deve ter no mínimo 8 caracteres.',
            'password.confirmed' => 'A confirmação de senha deve ser igual a original.',
        ];
    }
}
