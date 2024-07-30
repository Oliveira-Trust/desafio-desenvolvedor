<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuoteRequest extends FormRequest
{
    public function rules(): array
    {
        $this->merge([
            'original_amount' => sanitizaNumbers($this->original_amount),
            'payment_fee' => sanitizaNumbers($this->payment_fee),
            'conversion_fee' => sanitizaNumbers($this->conversion_fee),
            'converted_amount' => sanitizaNumbers($this->converted_amount),
            'final_amount' => sanitizaNumbers($this->final_amount),
            'value_target_currency' => sanitizaNumbers($this->value_target_currency),
        ]);
        return [
            'source_currency' => 'required|string',
            'target_currency' => 'required|string',
            'original_amount' => 'required|numeric|min:1000|max:100000',
            'payment_method' => 'required|string',
            'payment_fee' => 'required|numeric',
            'conversion_fee' => 'required|numeric',
            'converted_amount' => 'required|numeric',
            'final_amount' => 'required|numeric',
            'value_target_currency' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'original_amount.min' => 'O valor mínimo para cotação é de R$ 1.000,00',
            'original_amount.max' => 'O valor máximo para cotação é de R$ 100.000,00',
            'source_currency.required' => 'A moeda de origem é obrigatória',
            'target_currency.required' => 'A moeda de destino é obrigatória',
            'original_amount.required' => 'O valor original é obrigatório',
            'payment_method.required' => 'O método de pagamento é obrigatório',
            'payment_fee.required' => 'A taxa de pagamento é obrigatória',
            'conversion_fee.required' => 'A taxa de conversão é obrigatória',
            'converted_amount.required' => 'O valor convertido é obrigatório',
            'final_amount.required' => 'O valor final é obrigatório',
            'value_target_currency.required' => 'O valor da moeda de destino é obrigatório',
        ];
    }

    public function authorize(): true
    {
        return true;
    }
}
