<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class changeQuoteRatesRequest extends FormRequest
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
            'configs' => 'required|array',
            'configs.*.payment_method' => 'required|string|max:20|in:Boleto,CreditCard',
            'configs.*.payment_method_fee' => 'required|numeric|between:0,999.99',
            'configs.*.conversion_fee_threshold' => 'required|numeric|between:0,9999999999.99',
            'configs.*.conversion_fee_below_threshold' => 'required|numeric|between:0,999.99',
            'configs.*.conversion_fee_above_threshold' => 'required|numeric|between:0,999.99',
        ];
    }
}
