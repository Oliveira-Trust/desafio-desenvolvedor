<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class HistoryRequest extends FormRequest
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
            'filename' => [
                'string',
                Rule::requiredIf(!$this->exists('created_at'))
            ],
            'created_at' => [
                'date_format:Y-m-d',
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'filename.string' => 'Campo filename no formato string',
            'filename.required' => 'Obrigatório o campo filename ou created_at',
            'created_at.date_format' => 'Informe a data do campo created_at no formato Y-m-d',
        ];
    }
}
