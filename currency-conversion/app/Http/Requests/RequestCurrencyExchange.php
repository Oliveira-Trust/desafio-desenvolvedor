<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestCurrencyExchange extends FormRequest
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
      return[
        'initial_conversion_value' => 'required',
        'coin_exchange_to' => 'required',
        'form_of_payment' => 'required',

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
            'conversion_value.required' => 'O Campo Valor da Compra é obrigatório',
            'coin_exchange_to.required' => 'O Campo Moeda Destino é obrigatório',
            'form_of_payment.required' => 'O Campo Forma de Pagamento é obrigatório',
        ];
    }
}
