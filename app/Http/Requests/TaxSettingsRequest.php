<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaxSettingsRequest extends FormRequest
{
    public function rules()
    {
        return [
            'boleto_fee' => ['required', 'integer'],
            'credit_card_fee' => ['required', 'integer'],
            'conversion_fee_below_3000' => ['required', 'integer'],
            'conversion_fee_above_3000' => ['required', 'integer'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
