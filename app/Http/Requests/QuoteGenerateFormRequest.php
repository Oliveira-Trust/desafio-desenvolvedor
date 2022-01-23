<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuoteGenerateFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'destination-currency' => 'required|string',
            'money' => 'required|string',
            'bank-invoice' => 'sometimes|string',
            'credit-card' => 'sometimes|string'
        ];
    }
}
