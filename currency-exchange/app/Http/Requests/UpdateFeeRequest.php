<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\AboveAndBelow;

class UpdateFeeRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|numeric',
            'application' => 'required|string',
            'value' => 'required|numeric',
            'name' => 'required|string',
            'rate' => ['required', 'numeric', 'max:100', 'min:0']
        ];
    }
}

