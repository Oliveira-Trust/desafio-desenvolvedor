<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyConversionRequest extends FormRequest
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

    protected function prepareForValidation()
    {

        $this->merge([
            'origin_value' => str_replace(',', '.', str_replace('.', '', $this->origin_value))
        ]);

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cur_id' => 'required',
            'origin_value' => 'required|numeric|between:1000,100000',
            'payment_method' => 'required',
        ];    
    }
}