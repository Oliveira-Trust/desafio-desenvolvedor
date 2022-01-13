<?php

namespace App\Domain\Fee\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeeUpdateRequest extends FormRequest
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
            'dependsOn' => 'nullable|numeric|min:1000|max:100000',
            'fee'        => 'nullable|numeric|min:0|max:99'
        ];
    }


    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
      return [
          'dependsOn.numeric' => 'Quantia para desconto inválido',
          'dependsOn.min'     => 'Quantia para desconto deve ser no mínimo BRL 1.000',
          'dependsOn.max'     => 'Quantia para desconto deve ser no máximo BRL 100.000',

          'fee.numeric' => 'Porcentagem de desconto inválida',
          'fee.min'     => 'Porcentagem de desconto deve ser no mínimo 0%',
          'fee.max'     => 'Porcentagem de desconto deve ser no máximo 100%'
      ];
    }
}
