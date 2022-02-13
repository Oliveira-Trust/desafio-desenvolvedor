<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Anik\Form\FormRequest;

class LoginRequest extends FormRequest
{
    protected function authorize(): bool
    {
        return true;
    }

    protected function rules(): array
    {
        return [
            'email'     => 'required|string',
            'password'  => 'required|string',
        ];
    }
}
