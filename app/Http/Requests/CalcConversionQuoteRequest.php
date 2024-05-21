<?php

namespace App\Http\Requests;

use App\Services\AwesomeApiQuotes\AwesomeApiQuotesService;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CalcConversionQuoteRequest extends FormRequest
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
        $service = new AwesomeApiQuotesService();
        return [
            'currency' => [
                'required',
                Rule::in(array_keys($service->currencies()->available()))
            ],
            'amount' => ['required', 'numeric', 'min:1000', 'max:100000'],
            'fee' => ['required', 'numeric'],
            'payment_method' => ['required', 'in:payment_slip,credit_card']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.*
     * @return array
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
            'status' => true
        ], 422));
    }
}
