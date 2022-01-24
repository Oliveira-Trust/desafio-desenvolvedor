<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentMethodsFeeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            '*.slug' => [
                'required',
                'exists:payment_methods,slug',
            ],
            '*.fees' => [
                'required',
                'between:0.01,100',
            ]
        ];
    }
}
