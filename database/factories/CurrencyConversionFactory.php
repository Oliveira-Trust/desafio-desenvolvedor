<?php

namespace Database\Factories;

use App\Models\CurrencyConversion;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CurrencyConversionFactory extends Factory
{
    protected $model = CurrencyConversion::class;

    
    public function definition()
    {
        $conversionValue = $this->faker->randomFloat(2, 1000, 100000);
        $valuePaymentFee = $conversionValue * 0.0145;
        $valueConversionFee = $conversionValue * 0.02;
        $valueConversionDeductionFee = $conversionValue - $valuePaymentFee - $valueConversionFee;
        $purchasedValue = $valueConversionDeductionFee / 5.30;

        return [
            'conversion_value' => number_format($conversionValue, 2, '.', ''),
            'payment_type' => $this->faker->randomElement([1, 2]),
            'source_currency' => 'BRL',
            'target_currency' => $this->faker->currencyCode,
            'value_target_currency' => 5.30,
            'value_payment_fee' => number_format($valuePaymentFee, 2, '.', ''),
            'value_conversion_fee' => number_format($valueConversionFee, 2, '.', ''),
            'purchased_value' => number_format($purchasedValue, 2, '.', ''),
            'value_conversion_deductiong_fee' => number_format($valueConversionDeductionFee, 2, '.', ''),
            'user_id' => function () {
                return User::factory()->create()->id;
            },
        ];


    }
}
