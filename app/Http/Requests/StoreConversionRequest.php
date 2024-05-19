<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConversionRequest extends FormRequest
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
            'target_currency' => ['required', 'exists:currencies,code'],
            'amount' => ['required', 'numeric', 'min:1000.00', 'max:100000.00'],
            'payment_method_id' => ['required', 'exists:payment_methods,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'target_currency.required' => 'O campo moeda de destino é obrigatório.',
            'target_currency.exists' => 'O campo moeda de destino deve ser uma das opções disponíveis.',
            'amount.required' => 'O campo valor é obrigatório.',
            'amount.numeric' => 'O campo valor deve ser um número.',
            'amount.min' => 'O campo valor deve ser maior ou igual a R$1000.00.',
            'amount.max' => 'O campo valor deve ser menor ou igual a R$100000.00.',
            'payment_method_id.required' => 'O campo forma de pagamento é obrigatório.',
            'payment_method_id.exists' => 'O campo forma de pagamento deve ser uma das opções disponíveis.',
        ];
    }
}
