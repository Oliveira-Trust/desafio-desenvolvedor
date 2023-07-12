<?php

namespace App\Http\Requests\CurrencyConversion;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class getByUserIdRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'per_page' => 'required|integer|min:1',
            'order_by' => 'required|in:conversion_value,created_at,updated_at',
            'order_direction' => 'required|in:asc,desc',
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