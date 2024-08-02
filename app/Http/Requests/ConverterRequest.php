<?php

namespace App\Http\Requests;

use App\Enums\Currencies;
use App\Models\PaymentMethod;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ConverterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'destination' => [
                Rule::requiredIf(fn () => $this->isMethod('post')),
                Rule::in(array_column(Currencies::cases(), 'name')),
            ],
            'amount' => [
                Rule::requiredIf(fn () => $this->isMethod('post')),
                'numeric',
                'min:1000',
                'max:100000',
            ],
            'payment_method' => [
                Rule::requiredIf(fn () => $this->isMethod('post')),
                Rule::in(PaymentMethod::pluck('label')->toArray()),
            ],
        ];
    }
}
