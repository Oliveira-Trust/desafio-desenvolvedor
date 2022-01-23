<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyTaxRequest extends FormRequest
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
            'less_value' => 'required',
            'less_tax' => 'required',
            'bigger_value' => 'required',
            'bigger_tax' => 'required',
            'tax_credit_card' => 'required',
            'tax_bank_slip' => 'required',
        ];    
    }
}
