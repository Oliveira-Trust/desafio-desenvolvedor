<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class ArquivoRequest extends FormRequest
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
            'file' => ['required', File::types(['xlsx', 'csv', 'txt'])],
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => 'É preciso que você envie ao menos um arquivo.',
            'file.mimes' => 'Só é permitido arquivos com as extensões csv ou excel (xlsx).'
        ];
    }
}
