<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConversionRateFormRequest extends FormRequest
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
            "currency_value" => "required|numeric|gt:1000.01|lt:99999.99",
            "rate_greater_than" => "required|min:0",
            "rate_less_than" => "required|min:0",
        ];
    }
    public function attributes(): array
    {
        return [
            "currency_value" => "Valor para comparar",
            "rate_greater_than" => "Maior ou igual que",
            "rate_less_than" => "Menor que"
        ];
    }

    public function messages(): array
    {

        return [
            "currency_value.gt" => "O valor deve ser maior que R$ 1.001,01",
            "currency_value.lt" => "O valor deve ser menor que R$ 99.999,99"
        ];

    }
}
