<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
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
            'file' => [
                'required',
                'file',
                'mimes:xlsx,csv',
                'max:20480',
            ]
        ];
    }

    public function messages (): array
    {
        return [
            'required' => 'O arquivo é obrigatório.',
            'file' => 'O campo deve ser um arquivo xlsx ou csv.',
            'mimes' => 'O arquivo deve ser do tipo xlsx ou csv.',
            'max' => 'O arquivo não deve exceder 20 MB.',
        ];
    }
}
