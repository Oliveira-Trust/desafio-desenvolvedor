<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExchangeRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'currency' => 'required|exists:currencies,code',
            'payment_method' => 'required|exists:payment_methods,method',
            'ammount' => 'required|numeric|min:1000|max:100000'
        ];
    }
}
