<?php

namespace App\Http\Requests;

use App\Enums\CurrencyOrigin;
use App\Enums\CurrencyTarget;
use App\Enums\PaymentMethod;
use App\Enums\Regex;
use App\Rules\RangeCurrencyRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class ToConvertRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'currency_origin' => ['required', new Enum(CurrencyOrigin::class)],
            'target_currency' => ['required', new Enum(CurrencyTarget::class)],
            'value' => ['required', 'regex:' . Regex::REGEX_CURRENCY_BRL->value, new RangeCurrencyRule],
            'payment_method' => ['required', new Enum(PaymentMethod::class)],
        ];
    }
}
