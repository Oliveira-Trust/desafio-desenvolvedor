<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConverteFormRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'valorInicial'  =>'required|numeric|min:1001|max:99999',
            'tipoPagamento' =>'required|int',
            'moedaDestino'  =>'required|int',
        ];
    }

    public function messages(): array
    {
        return [
            'moedaDestino.required' =>'Selecione a moeda de destino',
            'tipoPagamento.required' =>'Seleciona o tipo de pagamento',
            'valorInicial.required'=>'Preencha o valor que deseja converter',
            'valorInicial.min'=>'O valor de conversão deve ser maior que R$ 1.000,00',
            'valorInicial.max'=>'O valor de conversão deve ser menor que R$ 100.000,00',
        ];
    }
}
