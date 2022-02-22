<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyConversionGetRequest extends FormRequest
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
            'origin_currency'      => 'required|exists:currencies,id',
            'destination_currency' => 'required|exists:currencies,id',
            'currency_value'       => 'required|numeric|min:1000.00|max:100000.00',
            'payment'              => 'required|exists:payments,id'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'origin_currency.required'      => 'A origin_currency is required',
            'destination_currency.required' => 'A destination_currency is required',
            'currency_value.required'       => 'A currency_value is required',
            'payment.required'              => 'A payment is required',

            'origin_currency.exists'      => 'A origin_currency is not exists',
            'destination_currency.exists' => 'A destination_currency is not exists',
            'payment.exists'              => 'A payment is not exists',
        ];
    }
}
