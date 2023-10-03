<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyExchangeSettingsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'boleto_payment_tax' => convertPercentValueToDecimal($this->boleto_payment_tax),
            'credit_card_payment_tax' => convertPercentValueToDecimal($this->credit_card_payment_tax),
            'base_value_conversion_tax' => convertBRLCurrencyToFloat($this->base_value_conversion_tax),
            'base_value_lower_conversion_tax' => convertPercentValueToDecimal($this->base_value_lower_conversion_tax),
            'base_value_greater_conversion_tax' => convertPercentValueToDecimal($this->base_value_greater_conversion_tax),
        ]);
    }

    public function rules()
    {
        return [
            'boleto_payment_tax' => [
                'required',
                'numeric',
                'min:0',
                'max:1',
            ],
            'credit_card_payment_tax' => [
                'required',
                'numeric',
                'min:0',
                'max:1',
            ],
            'base_value_conversion_tax' => [
                'required',
                'numeric',
                'min:1000',
                'max:99999.99',
            ],
            'base_value_lower_conversion_tax' => [
                'required',
                'numeric',
                'min:0',
                'max:1',
            ],
            'base_value_greater_conversion_tax' => [
                'required',
                'numeric',
                'min:0',
                'max:1',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'base_value_conversion_tax.min' => 'O valor mínimo é R$ 1.000,00',
        ];
    }

    public function attributes(): array
    {
        return [
            'boleto_payment_tax' => 'Taxa do boleto',
            'credit_card_payment_tax' => 'Taxa do cartão de crédito',
            'base_value_conversion_tax' => 'Valor base para taxa de conversão',
            'base_value_lower_conversion_tax' => 'Taxa de conversão para valores menores que o valor base',
            'base_value_greater_conversion_tax' => 'Taxa de conversão para valores maiores que o valor base',
        ];
    }
}
