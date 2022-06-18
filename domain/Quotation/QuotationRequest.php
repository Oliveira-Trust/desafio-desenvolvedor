<?php

namespace Oliveiratrust\Quotation;

use Illuminate\Foundation\Http\FormRequest;

class QuotationRequest extends FormRequest {

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
            'amount'          => 'required|numeric|min:1000|max:100000',
            'currency_id'     => 'required|exists:currencies,id',
            'payment_type_id' => 'required|exists:payment_types,id',
        ];
    }
}
