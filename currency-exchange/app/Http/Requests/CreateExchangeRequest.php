<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateExchangeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'value' => ['required', 'decimal:2', 'min:1000', 'max:100000'],
            'payment_method' => 'required|string',
            'base_currency' => 'required|string',
            'target_currency' => 'required|string'
        ];
    }
}
