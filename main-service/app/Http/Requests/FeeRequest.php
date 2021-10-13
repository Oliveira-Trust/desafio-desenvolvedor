<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeeRequest extends FormRequest
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
        $id = $this->fee ?? '';

        return [
            'type'        => ['required', 'string', "unique:fees,type,{$id},id"],
            'range'       => ['required', 'numeric'],
            'status'      => ['nullable', 'numeric'],
            'less_than'   => ['required', 'numeric'],
            'more_than'   => ['required', 'numeric'],
            'description' => ['required', 'string'],
        ];
    }
}
