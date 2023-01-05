<?php

namespace Modules\Exchange\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRatesRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'bank_slips' => 'required|numeric',
            'credit_card' => 'required|numeric',
            'purchase_price_above' => 'required|numeric',
            'purchase_price_below' => 'required|numeric',
            'purchase_price' => 'required|numeric'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
