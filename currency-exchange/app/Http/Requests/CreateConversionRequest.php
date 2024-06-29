<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\AboveAndBelow;

class UpdateFeeRequest extends FormRequest
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
            'id' => 'required|numeric',
            'application' => 'required|string',
            'value' => 'required|numeric',
            'name' => 'required|string',
            'percent' => [new AboveAndBelow, 'required', 'numeric', 'max:100', 'min:0']
        ];
    }
}
