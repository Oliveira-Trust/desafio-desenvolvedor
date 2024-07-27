<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyConversionRequest extends FormRequest
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
            'currency' => 'required|in:USD,GBP,JPY,EUR',
            'amount' => 'required|numeric|min:1000|max:100000',
            'payment_method' => 'required|in:boleto,credit_card'        
        ];
    }
    public function feedback()
    {
        [
            'amount.required' => 'Por favor, informe o valor para conversão.',
            'amount.min' => 'O valor para conversão deve ser maior que R$ 1.000,00.',
            'amount.max' => 'O valor para conversão não deve ultrapassar R$ 100.000,00.',
        ];
    }
}
