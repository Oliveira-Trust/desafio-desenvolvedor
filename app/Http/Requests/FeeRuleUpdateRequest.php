<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeeRuleUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'base_value' => 'required|decimal:0,2|min:1000|max:100000',
            'rules' => 'array',
            'rules.*.id' => 'required|exists:fee_rules,id',
            'rules.*.fee' => 'required|decimal:1,8'
        ];
    }
}
