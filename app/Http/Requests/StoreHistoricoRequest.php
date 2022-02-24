<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHistoricoRequest extends FormRequest
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
            'moeda_destino' => 'required|min:3',
            'forma_pagamento' => 'required|numeric',
            'valor' => 'required|numeric'
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
            'valor.required' => 'O campo Valor não foi informado.',
            'moeda_destino.required' => 'O campo Moeda Destino não foi informado.',
            'moeda_destino.min' => 'O campo Moeda Destino não foi informado.',
            'forma_pagamento.required' => 'O campo Forma de Pagamento não foi informado.',
            'forma_pagamento.numeric' => 'O campo Forma de Pagamento não foi informado.',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $inputs = $this->request->all();
            if ($inputs['valor'] < 1000) {
                $validator->errors()->add('valor', 'Campo Valor deve ser maior que R$1000,00!');
            }
            if ($inputs['valor'] > 100000) {
                $validator->errors()->add('valor', 'Campo Valor deve ser menor que R$1000,00!');
            }
            if ($inputs['moeda_destino'] == $inputs['moeda_origem']) {
                $validator->errors()->add('moeda_destino', 'Não é permitido Moedas com mesmo destino e Origem!');
            }
        });
    }
}
