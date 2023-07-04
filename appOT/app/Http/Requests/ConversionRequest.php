<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ConversionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return true;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
      return [
            'destination_currency' => 'required',
            'conversion_value' => 'required|numeric|min:1000|max:100000',
            'payment_method' => 'required|in:boleto,cartao',
        ];
    }

    public function messages()
    {
        
        return [
            'destination_currency.required' => 'O campo de moeda de destino é obrigatório.',
            'conversion_value.required' => 'O campo de valor de conversão é obrigatório.',
            'conversion_value.numeric' => 'O valor de conversão deve ser numérico.',
            'conversion_value.min' => 'O valor de conversão deve ser no mínimo :min.',
            'conversion_value.max' => 'O valor de conversão deve ser no máximo :max.',
            'payment_method.required' => 'O campo do método de pagamento é obrigatório.',
            'payment_method.in' => 'O método de pagamento selecionado é inválido.',
        ];
    }
    public function failedValidation(Validator $validator)
{
   throw new HttpResponseException(response()->json([
     'success'   => false,
     'message'   => 'Validation errors',
     'data'      => $validator->errors()
   ]));
}
}
