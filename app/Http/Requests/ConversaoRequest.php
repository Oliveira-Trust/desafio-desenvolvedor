<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ConversaoRequest extends FormRequest
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

        $rules = [
            'idTipoPagamento' => 'required',
            'idMoedaDestino' => 'required',
            'flValorConversao' => 'required|numeric|between: 1000,100000'
        ];

        if($this->isMethod('post') || $this->isMethod('put')){
            return $rules;
        }
        return [];

    }

    public function messages()
    {
        return [
            'idTipoPagamento.required' => 'Selecione um tipo de pagamento',
            'idMoedaDestino.required' => ' Selecione uma moeda destino.',
            'flValorConversao.required' => 'Obrigatório informar um valor para conversão.',
            'flValorConversao.between' => 'O Valor para conversão deve estar entre R$ :min e R$ :max.'
        ];
    }

    /**
     * Custom name attributes.
     *
     * @return array
     */

    public function attributes()
    {
        return [
            'idTipoPagamento' => 'Tipo de Pagamento',
            'flValorConversao' => 'Moeda Destino',
            'flValorConversao' => 'Valor'
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator) : void
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
