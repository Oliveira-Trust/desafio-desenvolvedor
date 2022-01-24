<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuoteGenerateFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return string[] */
    public function rules(): array
    {
        return [
            'destination_currency' => 'required|string',
            'money' => 'required|numeric',
            'payment' => 'required',
        ];
    }

    /** @return string[] */
    public function messages(): array
    {
        return [
            'destination_currency.required' => 'Moeda de Destino é obrigatório',
            'money.required' => 'Valor é obrigatório',
            'payment.required' => 'Escolha a forma de pagamento',
        ];
    }

}
