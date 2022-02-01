<?php

namespace App\Api\Purchase\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'origin' => ['required', 'string', 'min:2', 'max:5'],
            'destiny' => ['required', 'string', 'min:2', 'max:5'],
            'value' => ['required', 'numeric', 'between:1000,100000'],
            'payment_method' => ['required', 'string', 'exists:payment_methods,name'],
        ];
    }

    public function messages(): array
    {
        return [
            'value.between' => 'O valor da compra deve ser entre :min e :max',
        ];
    }
}
