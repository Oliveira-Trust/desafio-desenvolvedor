<?php

namespace App\Http\Requests;

use App\Enums\CurrencyOptionsEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class ConversionRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'currency'  => ['required', Rule::in(\App\Enums\CurrencyOptionsEnum::names())],
            'quantity'  => ['required', 'int', 'min:1000', 'max:100000'],
            'type'      => ['required', Rule::in(\App\Enums\PaymentTypsEnum::names())],
        ];
    }
}
