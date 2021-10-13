<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentMethodRequest extends FormRequest
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
        $id = $this->payment_method ?? '';

        return [
            'method' => ['required', 'string', "unique:payment_methods,method,{$id},id"],
            'fee'    => ['required', 'numeric'],
            'status' => ['required', 'boolean'],
        ];
    }
}
