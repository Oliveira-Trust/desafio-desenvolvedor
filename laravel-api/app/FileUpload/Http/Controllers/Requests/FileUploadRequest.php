<?php

namespace App\FileUpload\Http\Controllers\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileUploadRequest extends FormRequest
{
    /**
     * Create a new class instance.
     */
    public function rules(): array
    {
        return [
            'file' => ['required', 'file', 'mimes:csv,xlsx,xls,txt', 'max:204800'],
        ];
    }

    public function messages(): array
    {
        return [
            'file.mimes' => 'Only CSV and Excel files are allowed.',
            'file.max' => 'File must not exceed 200MB.',
        ];
    }
}
