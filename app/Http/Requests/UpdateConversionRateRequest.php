<?php

namespace App\Http\Requests;

use App\Helpers\StringHelpers;
use Illuminate\Foundation\Http\FormRequest;

class UpdateConversionRateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'value' => 'required|numeric',
            'rate' => 'required|numeric|min:0',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'value.required' => 'O valor é obrigatório',
            'value.numeric' => 'O valor deve estar no formato numérico',
            'rate.required' => 'O valor é obrigatório',
            'rate.numeric' => 'O valor deve estar no formato numérico',
            'rate.min' => 'Taxa inválida',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'value' => StringHelpers::formatValue($this->value),
        ]);
    }
}
