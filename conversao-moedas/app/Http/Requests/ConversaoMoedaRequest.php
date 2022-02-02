<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConversaoMoedaRequest extends FormRequest
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
            'moedaDestino'    => 'required',
            'valorConversao'  => 'required',
            'formaPagamento'  => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'moedaDestino'     => 'Moeda de Destino',
            'valorConversao'   => 'Valor de Conversão',
            'formaPagamento'   => 'Forma de Pagamento',
        ];
    }
}
