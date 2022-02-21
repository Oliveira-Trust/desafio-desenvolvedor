<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CotacaoRequest extends FormRequest
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
            'forma_pagamento' => [
                'required',
                Rule::in([1, 2]),
            ],
            'valor_conversao' => 'required|numeric|between:1000,100000'
        ];
    }

    public function messages(){
        return [
            'forma_pagamento.required' => 'A forma de pagamento é requirido',
            'valor_conversao.required' => 'O valor de conversão é requirido',
            'valor_conversao.numeric' => 'O valor de conversão é um campo numérico',
            'valor_conversao.between' => 'O valor de conversão tem que estar entre 1000 e 100000'
        ];
    }
}
