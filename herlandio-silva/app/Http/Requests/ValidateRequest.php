<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateRequest extends FormRequest
{
    /**
     * The authorize function in PHP always returns true.
     * 
     * @return bool The function `authorize()` is returning a boolean value `true`.
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
            'from_currency' => 'required',
            'to_currency' => 'required',
            'amount' => 'required|numeric',
            'payment_method' => 'required',
        ];
    }

    /**
     * The function returns an array of error messages for specific validation rules in a PHP
     * application.
     * 
     * @return array An array of custom error messages for form validation rules.
     */
    public function messages(): array
    {
        return [
            'from_currency.required' => 'A moeda de origem é obrigatória.',
            'to_currency.required' => 'A moeda de destino é obrigatória.',
            'amount.required' => 'O valor para conversão é obrigatório.',
            'amount.numeric' => 'O valor deve ser um número.',
            'payment_method.required' => 'A forma de pagamento é obrigatória.',
        ];
    }
}
