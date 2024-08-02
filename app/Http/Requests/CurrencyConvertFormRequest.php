<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyConvertFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "amount" => "required|numeric|gt:1000|lt:100000",
            "currency_destination" => "required",
            "payment_method" => "required|exists:payment_methods,id"
        ];
    }
    public function attributes(): array
    {
        return [
            "amount" => "Valor",
            "currency_destination" => "Moeda de Destino",
            "payment_method" => "Método de Pagamento"
        ];
    }

    public function messages(): array
    {

        return [
            "amount.gt" => "O valor deve ser maior que R$ 1.000,00",
            "amount.lt" => "O valor deve ser menor que R$ 100.000,00"
        ];

    }

}
