<?php

namespace Oliveiratrust\Fee;

use Illuminate\Foundation\Http\FormRequest;

class FeeRequest extends FormRequest {

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
            'fee_type_id'     => 'required|exists:fee_types,id',
            'payment_type_id' => 'required|exists:payment_types,id',
            'min_amount'      => 'required|numeric|min:0|max:100000',
            'max_amount'      => 'required|numeric|min:0.01|max:100000',
            'percent'         => 'required|numeric|min:0|max:100000',
            'fixed_value'     => 'required|numeric|min:0|max:100000'
        ];
    }
}
