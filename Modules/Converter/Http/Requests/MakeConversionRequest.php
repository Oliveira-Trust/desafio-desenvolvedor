<?php

namespace Modules\Converter\Http\Requests;

use Modules\Converter\Helpers\FormatHelper;
use Illuminate\Foundation\Http\FormRequest;

class MakeConversionRequest extends FormRequest
{
    public function prepareForValidation()
    {
        $valueForConversion = FormatHelper::currencyStringToFloat($this->input('value_to_convert'));
        $this->merge(['value_to_convert' => $valueForConversion]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'destination_currency' => 'required|string|min:3|in:USD,EUR|not_in:BRL',
            'value_to_convert' => 'required|numeric|between:1000,100000',
            'payment_method' => 'required|string|in:boleto,credit_card'
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
