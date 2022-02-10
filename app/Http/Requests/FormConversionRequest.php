<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormConversionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
            'initial_currency' => 'required|string',
            'final_currency' => 'required|string',
            'amount_to_convert' => 'required|numeric|min:1000|max:100000',
            'payment_method' => 'required|string'
        ];
    }

    /**
     * Set the validation messages for the form fields
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'initial_currency.required' => "O campo \"Moeda Corrente\" é obrigatório.",
            'final_currency.required' => "O campo \"Moeda Desejada\" é obrigatório.",

            'amount_to_convert.required' => "O campo \"Valor\" é obrigatório.",
            'amount_to_convert.numeric' => "O campo \"Valor\" deve ser um número.",
            'amount_to_convert.min' => "O valor mínimo para a compra é de mil reais (R$ 1.000,00)",
            'amount_to_convert.max' => "O valor máximo para a compra é de cem mil reais (R$ 100.000,00)",

            'payment_method.required' =>  "O campo \"Método de Pagamento\" é obrigatório.",
        ];
    }
}
