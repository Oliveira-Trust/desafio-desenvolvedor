<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SignupRequest extends FormRequest {
    public function rules(): array {
        return [
            'email'    => ['required', 'email', Rule::unique(User::class,'email')],
            'name'     => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
        ];
    }
}
