<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValueRangeRule;
use App\Services\CurrencyService;

class CurrencyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $availableCurrencies = array_keys(app(CurrencyService::class)->getAvaliableCurrencies());
        $availablePaymentMethods = array_keys(config('payment_methods'));

        return [
            'value' => ['required', new ValueRangeRule()],
            'currency' => 'required|in:' . implode(',', $availableCurrencies),
            'payment_method' => 'required|in:' . implode(',', $availablePaymentMethods)
        ];
    }
}
