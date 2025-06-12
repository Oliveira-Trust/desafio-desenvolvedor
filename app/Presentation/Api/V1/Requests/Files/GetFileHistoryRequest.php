<?php

namespace Presentation\Api\V1\Requests\Files;

use Illuminate\Foundation\Http\FormRequest;

class GetFileHistoryRequest extends FormRequest {
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'filename' => ['required', 'string', 'min:3', 'max:120'],
            'date' => ['required', 'string', 'date'],
        ];
    }
}
