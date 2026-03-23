<?php

namespace App\Domains\Upload\Presentation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexUploadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
            'filename' => ['nullable', 'string', 'max:255'],
            'date' => ['nullable', 'date_format:Y-m-d'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'per_page' => $this->input('per_page'),
            'filename' => $this->sanitizeSearchString($this->input('filename')),
            'date' => $this->sanitizeSearchString($this->input('date')),
        ]);
    }

    private function sanitizeSearchString(mixed $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $normalized = trim((string) $value);
        $normalized = preg_replace('/[\x00-\x1F\x7F]/u', '', $normalized);

        return $normalized === '' ? null : $normalized;
    }
}
