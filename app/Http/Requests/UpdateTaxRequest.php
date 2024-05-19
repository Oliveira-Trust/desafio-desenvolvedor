<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaxRequest extends FormRequest
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
            'amount' => 'sometimes|numeric|min:1000|max:100000',
            'rate' => 'sometimes|numeric|min:0.01|max:99',
            'min_amount_rate' => 'sometimes|numeric|min:0.01|max:99',
            'max_amount_rate' => 'sometimes|numeric|min:0.01|max:99',
        ];
    }

    public function messages(): array
    {
        //portuguese
        return [
            'amount.min' => 'A taxa deve ser pelo menos R$1000.00',
            'amount.max' => 'A taxa deve ser pelo menos R$1000.00',
            'rate.min' => 'A taxa deve ser pelo menos 0.01%',
            'rate.max' => 'A taxa deve ser pelo menos 99%',
            'min_amount_rate.min' => 'A taxa deve ser pelo menos 0.01%',
            'max_amount_rate.max' => 'A taxa deve ser pelo menos 99%',
            'max_amount_rate.min' => 'A taxa deve ser pelo menos 0.01%',
            'min_amount_rate.max' => 'A taxa deve ser pelo menos 99%',
        ];
    }
}
