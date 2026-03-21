<?php

namespace App\Domains\Upload\Presentation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUploadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'file' => [
                'required',
                'file',
                'max:79872',
                'extensions:csv,xls,xlsx',
                'mimetypes:text/plain,text/csv,application/csv,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'file.max' => 'O arquivo deve ter no máximo 78 MB.',
        ];
    }
}
