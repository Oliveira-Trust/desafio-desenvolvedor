<?php

namespace App\Http\Requests;

use App\Enum\CurrencyEnum;
use App\Enum\PaymentMethodEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CurrencyConversionRequest extends FormRequest
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
            'target' => ['required', 'string', (new Enum(CurrencyEnum::class))->except(CurrencyEnum::BRL)],
            'conversion_value' => ['required', 'integer', 'min:100000', 'max:10000000'],
            'payment_method' => ['required', 'string', new Enum(PaymentMethodEnum::class)],
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'target' => [
                'description' => 'Desired conversion currency',
                'example' => 'USD',
            ],
            'conversion_value' => [
                'description' => 'Value to convert to the desired currency. Must be multiplied by 100 ex: 199,99 => 19999',
                'example' => 19999,
            ],
            'payment_method' => [
                'description' => 'Payment method used to convert the currency. `CREDIT_CARD` or `BANK_BILLET`',
                'example' => 'BANK_BILLET',
            ],
        ];
    }
}
