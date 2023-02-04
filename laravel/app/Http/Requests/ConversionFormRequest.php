<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConversionFormRequest extends FormRequest
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
            'currency_origin' => 'required',
            'currency_buy' => 'required',
            'amount' => 'required|numeric|min:1000.00|max:100000.00',
            'payment_type' => 'required|in:boleto,credit_card',
        ];
    }

    public function messages()
    {
        return [
            'currency_origin.required' => 'É necessário informar a moeda origem.',
            'currency_buy.required' => 'É necessário informar a moeda destino.',
            'amount.required' => 'É necessário informar o valor.',
            'amount.min' => 'O valor informado deve ser no mínimo R$ 1.000.00.',
            'amount.max' => 'O valor informado deve ser no máximo R$ 10.000.00.',
            'payment_type.required' => 'É necessário informar a forma de pagamento.',
        ];
    }
}
