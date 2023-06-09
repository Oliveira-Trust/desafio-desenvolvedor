<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CotationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'origin_currency' => 'required',
            'destination_currency' => 'required',
            'conversion_amount' => 'required|numeric|min:1000|max:100000',
            'payment_method' => 'required',
        ];
    }
}
