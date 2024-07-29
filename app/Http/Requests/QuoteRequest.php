<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuoteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users'],
            'source_currency' => ['required'],
            'target_currency' => ['required'],
            'original_amount' => ['required', 'integer'],
            'payment_method' => ['required'],
            'payment_fee' => ['required', 'integer'],
            'conversion_fee' => ['required', 'integer'],
            'converted_amount' => ['required', 'integer'],
            'final_amount' => ['required', 'integer'],
        ];
    }

    public function authorize(): true
    {
        return true;
    }
}
