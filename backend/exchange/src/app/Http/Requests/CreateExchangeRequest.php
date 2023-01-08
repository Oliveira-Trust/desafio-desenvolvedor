<?php

namespace App\Http\Requests;

use App\Models\Currency;
use App\Models\PaymentMethod;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateExchangeRequest extends FormRequest {
    public function rules(): array {
        return [
            'user_id'                 => ['required', 'int'],
            'origin_value'            => ['required', 'numeric', 'between:1000,100000'],
            'email'                   => ['required', 'email'],
            'destination_currency_id' => [
                'required',
                'int',
                Rule::exists(Currency::class, 'id')->where('available_to_buy', true),
            ],
            'payment_method_id'       => [
                'required',
                'int',
                Rule::exists(PaymentMethod::class, 'id'),
            ],
        ];
    }
}
