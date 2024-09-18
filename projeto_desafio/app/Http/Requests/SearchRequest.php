<?php

namespace App\Http\Requests;

use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class SearchRequest extends FormRequest
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
            'TckrSymb' => 'string|max:255',
            'RptDt' => 'string|max:255',
        ];
    }

    protected function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            $hasTckrSymb = $this->input('TckrSymb');
            $hasRptDt = $this->input('RptDt');

            if ($hasTckrSymb xor $hasRptDt) {
                $validator->errors()->add('missing_field', 'Os campos TckrSymb e RptDt devem ser fornecidos juntos.');
            }
        });
    }

    public function messages(): array
    {
        return [
            'TckrSymb.string' => 'O campo TckrSymb deve ser uma string.',
            'RptDt.string' => 'O campo RptDt deve ser uma string.',
        ];
    }
}
