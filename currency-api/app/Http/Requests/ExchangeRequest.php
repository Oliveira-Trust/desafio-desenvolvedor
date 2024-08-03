<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExchangeRequest extends FormRequest
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
            'source_currency' => 'required|string',
            'destination_currency' => 'required|string',
            'payment_method' => 'required|string|exists:payment_methods,id',
            'original_amount' => 'required|numeric|between:1000,100000'
        ];
    }
}
