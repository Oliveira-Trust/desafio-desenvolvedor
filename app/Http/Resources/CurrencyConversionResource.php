<?php

namespace App\Http\Resources;

use App\Enums\Currency;
use App\Enums\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyConversionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {   
        return [
            'id' => $this->id,
            'destination_currency' => $this->destination_currency,
            'destination_currency_name' => Currency::getValue($this->destination_currency),
            'value_conversion' => $this->formatCurrency($this->value_conversion),
            'payment_method_id' => $this->payment_method_id,
            'value_currency_conversion' => $this->formatCurrency($this->value_currency_conversion),
            'purchased_value_currency' => $this->formatCurrency($this->purchased_value_currency),
            'payment_rate' => $this->formatCurrency($this->payment_rate),
            'conversion_rate' => $this->formatCurrency($this->conversion_rate),
            'applied_conversion_rate' => $this->calculateAppliedConversionRate(),
            'amount_conversions_subtracting_fees' => $this->formatCurrency($this->amount_conversions_subtracting_fees),
            'user_id' => $this->user_id,
            'created_at' => $this->created_at->format('d/m/Y H:i'),
            'updated_at' => $this->updated_at->format('d/m/Y H:i'),
            'payment_method' => [
                'id' => $this->payment_method->id,
                'name' => $this->payment_method->name,
                'fee_percentage' => PaymentMethod::from($this->payment_method->id)->getFeePercentage(),
                'created_at' => $this->payment_method->created_at->format('Y-m-d'),
                'updated_at' => $this->payment_method->updated_at->format('Y-m-d'),
            ],
        ];
    }

    /**
     * Format a number as currency.
     *
     * @param  float  $value
     * @return string
     */
    protected function formatCurrency(float $value): string
    {
        return number_format($value, 2, ',', '.');
    }

    /**
     * Calculate the applied conversion rate.
     *
     * @return float
     */
    protected function calculateAppliedConversionRate(): float
    {
        return $this->value_conversion > 0 ? ($this->conversion_rate / $this->value_conversion) * 100 : 0;
    }
}
