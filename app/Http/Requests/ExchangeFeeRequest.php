<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExchangeFeeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            '*.id' => [
                'required',
                'exists:exchange_fees,id'
            ],
            '*.min_amount' => [
                'required',
                'integer',
                'min:1'
            ],
            '*.max_amount' => [
                'required',
                'integer',
                'min:1'
            ],
            '*.fees' => [
                'required',
                'between:0.01,100',
            ]
        ];
    }
}
