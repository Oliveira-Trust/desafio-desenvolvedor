<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConversionRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'target_coin' => 'string|different:source_coin|required',
            'source_coin' => 'in:BRL|required',
            'payment_method' => 'string|in:bill,credit_card|required',
            'value' => 'numeric|min:1000|max:100000|required'
        ];
    }

    public function  messages()
    {
        return [
            'source_coin.in' => 'Source coin must be BRL',
            'target_coin.different' => 'Target coin must be a different COIN than BRL',
            'payment_method.in' => 'Payment method must be bill or credit_card',
        ];
    }
}
