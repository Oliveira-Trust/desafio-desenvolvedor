<?php

namespace App\Http\Requests\CurrencyConversion;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class RegisterCurrencyConversionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'conversion_value' => 'required|numeric|between:1000,100000',
            'payment_type' => 'required|integer|in:1,2',
            'target_currency' => 'required|string|size:3|not_in:BRL',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'message' => 'The given data was invalid.',
            'errors' => $validator->errors(),
        ], 422));
    }
}
