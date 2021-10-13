<?php

namespace App\Http\Requests;

use App\Rules\RangeNumber;
use Illuminate\Foundation\Http\FormRequest;

class QuotationRequest extends FormRequest
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
            'currency' => ['required'],
            'amount' => ['required', new RangeNumber],
            'method' => ['required']
        ];
    }
}
