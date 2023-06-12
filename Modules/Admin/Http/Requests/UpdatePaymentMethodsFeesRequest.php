<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Converter\Helpers\FormatHelper;

class UpdatePaymentMethodsFeesRequest extends FormRequest
{

    public function prepareForValidation()
    {
        $this->merge([
            'boleto' => FormatHelper::inputNumberStringToFloat($this->input('boleto')),
            'credit_card' => FormatHelper::inputNumberStringToFloat($this->input('credit_card'))
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
            'boleto' => 'required|min:0|max:100|numeric',
            'credit_card' => 'required|min:0|max:100|numeric',
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
