<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
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
            'currency_destination' => ['required', 'in:USD,EUR'],
            'amount' => ['required', 'numeric', 'gt:0', 'min:1000', 'max:100000000'],
            'payment_method' => ['required', 'in:bank_slip,credit_card'],
        ];
    }
}
