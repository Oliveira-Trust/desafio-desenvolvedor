<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileUploadRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'file' => 'required|file|mimes:csv,xlsx,xls|max:10240', // 10 MB
        ];
    }
}
