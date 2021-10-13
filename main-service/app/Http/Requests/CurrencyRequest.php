<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyRequest extends FormRequest
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
        $id = $this->currency ?? '';

        return [
            'name'   => ['required', 'string', "unique:currencies,name,{$id},id", 'min:3', 'max:100'],
            'code'   => ['required', 'string', "unique:currencies,code,{$id},id", 'min:3', 'max:6'],
            'status' => ['required', 'boolean'],
        ];
    }
}
