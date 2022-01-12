<?php

namespace App\Domain\Price\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PriceStoreRequest extends FormRequest
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
            'targetCurrency' => 'required|exists:currencies,id',
            'paymentMethod'  => 'required|exists:payment_types,id',
            'amount'         => 'required|numeric|min:1000|max:100000'
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
      return [
          'targetCurrency.required' => 'Moeda Destino é obrigatório',
          'targetCurrency.exists'   => 'Moeda Destino inválida',

          'paymentMethod.required' => 'Método de pagamento é obrigatório',
          'paymentMethod.exists'   => 'Moeda Destino inválida',

          'amount.required' => 'Quantia é obrigatório',
          'amount.numeric'  => 'Quantia inválida',
          'amount.min' =>  'A quantia deve ser de no mínimo 1.000 reais',
          'amount.max' =>  'A quantia deve ser de no máximo 100.000 reais'
      ];
    }
}
