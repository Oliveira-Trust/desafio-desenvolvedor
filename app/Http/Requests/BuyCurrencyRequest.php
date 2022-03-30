<?php

namespace App\Http\Requests;

use App\Exceptions\ValidatorException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class BuyCurrencyRequest extends FormRequest
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
            'origin_currency' => 'required|in:BRL',
            'origin_currency_value' => 'required|numeric|between:1000,100000',
            'destination_currency_id' => [
                'required',
                Rule::exists('currencies', 'id')->where(function ($query) {
                    return $query->where('status', true);
                }),
            ],
            'destination_currency_value' => 'nullable|numeric',
            'convertion_fee' => 'nullable|numeric',
            'convertion_fee_value' => 'nullable|numeric',
            'payment_fee' => 'nullable|numeric',
            'payment_fee_value' => 'nullable|numeric',
            'payment_type_id' => [
                    'required',
                    Rule::exists('payment_types', 'id')->where(function ($query) {
                        return $query->where('status', true);
                    })
                ],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        try{
            parent::failedValidation($validator);
        } catch (ValidationException $e) {
            throw new ValidatorException($e->errors());
        }
    }
}
