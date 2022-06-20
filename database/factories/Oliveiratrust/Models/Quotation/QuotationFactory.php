<?php

namespace Database\Factories\Oliveiratrust\Models\Quotation;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Oliveiratrust\Models\Quotation\Quotation;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Oliveiratrust\Models\Quotation\Quotation>
 */
class QuotationFactory extends Factory {

    protected $model = Quotation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id'           => 1,
            'payment_type_id'   => $this->faker->numberBetween(1, 2),
            'currency_id'       => $currency_id = $this->faker->numberBetween(2, 4),
            'currency_price_id' => ($currency_id - 1),
            'amount'            => $amount = $this->faker->numberBetween(1000, 100000),
            'price'             => $price = $this->faker->numberBetween(5, 7),
            'fees'              => [
                '1'     => $fee1 = $this->faker->numberBetween(20, 100),
                '2'     => $fee2 = $this->faker->numberBetween(20, 100),
                'total' => $total = ($fee1 + $fee2)
            ],
            'exchanged_amount'  => round(($amount - $total) / $price, 2)
        ];
    }
}
