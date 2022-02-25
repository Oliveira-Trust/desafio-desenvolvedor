<?php

namespace App\Http\Requests;

use App\Helpers\StringHelpers;
use Illuminate\Foundation\Http\FormRequest;

class StoreConvertRequest extends FormRequest
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
            'value' => 'required|numeric|min:1000|max:100000',
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
            'value.min' => 'O valor de compra deve ser maior que R$ 1.000',
            'value.max' => 'O valor de compra deve ser menor que R$ 100.000,00',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'value' => StringHelpers::formatValue($this->value),
        ]);
    }
}
