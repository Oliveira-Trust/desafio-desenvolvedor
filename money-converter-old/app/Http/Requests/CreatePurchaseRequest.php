<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePurchaseRequest extends FormRequest
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
            'origin' => ['required', 'string', 'min:2', 'max:5'],
            'destiny' => ['required', 'string', 'min:2', 'max:5'],
            'value' => ['required', 'numeric', 'between:1000,100000'],
            'payment_type' => ['required', 'string', 'exists:payment_types,name'],
        ];
    }

    public function messages()
    {
        return [
            'value.between' => 'O valor da compra deve ser entre :min e :max',
        ];
    }
}
