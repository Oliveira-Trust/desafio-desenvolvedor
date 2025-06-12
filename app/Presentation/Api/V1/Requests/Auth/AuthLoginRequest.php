<?php

namespace Presentation\Api\V1\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AuthLoginRequest extends FormRequest {
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email', 'min:3', 'max:130'],
            'password' => ['required', 'string', 'min:3', 'max:100'],
        ];
    }
}
