<?php

namespace App\Http\Requests;

use App\Enums\PaymentType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CurrencyExchangeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        //        dd(request()->all());
        $this->merge([
            'conversion_value' => convertBRLCurrencyToFloat($this->conversion_value),
        ]);
    }

    public function rules()
    {
        if (request()->isMethod('get')) {
            return [];
        }

        return [
            'source_currency' => [
                'required',
                'min:3',
                'max:15',
            ],
            'destination_currency' => [
                'required',
                'min:3',
                'max:15',
                'different:source_currency',
            ],
            'conversion_value' => [
                'required',
                'numeric',
                'min:1000',
                'max:99999',
            ],
            'payment_type' => [
                'required',
                Rule::in(PaymentType::getValues()),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'conversion_value.min' => 'O valor mínimo para conversão é R$ 1.000,00',
        ];
    }

    public function attributes(): array
    {
        return [
            'source_currency' => 'Moeda de origem',
            'destination_currency' => 'Moeda de destino',
            'conversion_value' => 'Valor para conversão',
            'payment_type' => 'Forma de Pagamento',
            'payment_tax' => 'Taxa de pagamento',
            'conversion_tax' => 'Taxa de conversão',
        ];
    }
}
