<?php

namespace App\Http\Requests\Conversion;

use App\Models\Conversion;
use App\Models\Exchange;
use Illuminate\Foundation\Http\FormRequest;

class StoreConversionRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'coin_price_id' => 'required|exists:coin_prices,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'value' => 'required|numeric|min:1000|max:100000'
        ];
    }

    public function store(): Conversion
    {
        $conversion = Conversion::create($this->only('coin_price_id', 'value'));

        $this->createExchange($conversion);

        return $conversion;
    }

    private function createExchange(Conversion $conversion): Exchange
    {
        $exchange = new Exchange([
            'user_id' => $this->user()->id,
            'conversion_id' => $conversion->id,
            'payment_method_id' => $this->get('payment_method_id'),
        ]);
        $exchange->calculatePriceForSaving();
        $exchange->save();

        return $exchange;
    }
}
