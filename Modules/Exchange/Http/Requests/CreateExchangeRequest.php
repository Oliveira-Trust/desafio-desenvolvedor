<?php

namespace Modules\Exchange\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Exchange\Enums\Currency;
use Modules\Exchange\Enums\PaymentMethod;

class CreateExchangeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'destination_currency' => ['required', Rule::in(Currency::values())],
            'conversion_value' => 'required|numeric|between:1000.00,100000.00',
            'payment_method' => ['required', Rule::in(PaymentMethod::values())],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
