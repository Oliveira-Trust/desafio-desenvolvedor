<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Exceptions\ConversionException;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class EconomyQuotationFormRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $method = $this->route()?->getActionMethod();

        return Arr::get([
            'conversion' => self::conversion(),
        ], $method, []);
    }

    /**
     * @return string[]
     */
    private static function conversion(): array
    {
        return [
            'from' => 'required|string|max:6',
            'to' => 'required|string|max:6',
            'payment' => 'required|string|max:100',
            'amount' => 'required|numeric|min:0',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        foreach ($validator->errors()->all() as $errorMessage) {
            throw ConversionException::fieldsRequired($errorMessage);
        }
    }
}
