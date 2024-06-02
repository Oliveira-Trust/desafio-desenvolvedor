<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class getHistoricalQuotesRequest extends FormRequest
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
            'page' => 'integer|min:1',
            'perPage' => 'integer|min:1',
            'sortKey' => 'string|in:id,name,created_at,origin_currency,destination_currency,original_amount,converted_amount,payment_method,email_sent',
            'sortOrder' => 'string|in:asc,desc',
        ];
    }
}
