<?php

namespace Presentation\Api\V1\Requests\Files;

use Illuminate\Foundation\Http\FormRequest;

class SearchFileContentRequest extends FormRequest {
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            's' => ['required', 'string', 'min:3', 'max:30'],
        ];
    }
}
