<?php

namespace App\Http\Requests;

use App\Models\PaymentMethod;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuoteRequest extends FormRequest
{
    public function rules()
    {
        return [
            'amount' => [
                'required',
                'integer',
                'min:1000',
                'max:100000',
            ],
            'origin_currency' =>  [
                'required',
                'string',
                'in:BRL',
            ],
            'destination_currency' =>  [
                'required',
                'string',
                'different:origin_currency',
                Rule::in(config('currency.available_currencies')),
            ],
            'payment_method' =>  [
                'required',
                'string',
                'in:credit-card,billet',
            ],
        ];
    }

    public function getPaymentMethod()
    {
        return PaymentMethod::whereSlug($this->payment_method)->firstOrFail();
    }

    public function messages()
    {
        return [
          'amount.min' => 'O valor mínimo é de R$ :min',
          'amount.max' => 'O valor máximo é de R$ :max',
        ];
    }
}
