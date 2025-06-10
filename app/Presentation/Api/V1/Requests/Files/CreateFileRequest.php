<?php

namespace Presentation\Api\V1\Requests\Files;

use Illuminate\Foundation\Http\FormRequest;

class CreateFileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'files' => ['required', 'file', 'min:1', 'max:3', 'extensions:csv,xls,xlsx'],
        ];
    }
}
