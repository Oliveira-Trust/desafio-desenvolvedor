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
            'taxes' => 'required|array',
            'taxes.*.id' => 'required|numeric|max:255',
            'taxes.*.amount' => 'nullable|numeric|min:1000|max:100000',
            'taxes.*.rate' => 'nullable|numeric|min:0.01|max:99',
            'taxes.*.min_amount_rate' => 'nullable|numeric|min:0.01|max:99',
            'taxes.*.max_amount_rate' => 'nullable|numeric|min:0.01|max:99',
        ];
    }
}
