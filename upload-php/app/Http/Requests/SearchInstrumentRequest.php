<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchInstrumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'TckrSymb' => ['nullable', 'string'],
            'RptDt' => ['nullable', 'date'],
        ];
    }
}
