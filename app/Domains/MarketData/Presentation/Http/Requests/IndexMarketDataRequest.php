<?php

namespace App\Domains\MarketData\Presentation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexMarketDataRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'TckrSymb' => ['nullable', 'string', 'max:20', 'regex:/^[A-Z0-9]+$/'],
            'RptDt' => ['nullable', 'date_format:Y-m-d'],
            'page' => ['nullable', 'integer', 'min:1'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'TckrSymb' => $this->sanitizeTicker($this->input('TckrSymb')),
            'RptDt' => $this->sanitizeSearchString($this->input('RptDt')),
            'page' => $this->input('page'),
            'per_page' => $this->input('per_page'),
        ]);
    }

    private function sanitizeTicker(mixed $value): ?string
    {
        $normalized = $this->sanitizeSearchString($value);

        if ($normalized === null) {
            return null;
        }

        return strtoupper($normalized);
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
