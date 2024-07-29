<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestConversaoMoeda extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'valor' => preg_replace('/\D/', '', $this->valor),
        ]);
    }

    public function rules(): array
    {
        return [
            'moeda_destino' => ['required', 'string', 'in:USD,BTC'],
            'valor' => ['required', 'numeric', 'min:1000', 'max:100000'],
            'forma_pagamento' => ['required', 'string', 'in:boleto,credit_card'],
        ];
    }
}
