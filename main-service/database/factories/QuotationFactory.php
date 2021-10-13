<?php

namespace Database\Factories;

use App\Models\Quotation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuotationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Quotation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'           => User::factory(),
            'from_currency'     => $this->faker->currencyCode(),
            'to_currency'       => $this->faker->currencyCode(),
            'amount'            => $this->faker->randomNumber(),
            'payment_method'    => $this->faker->creditCardType(),
            "payment_fee"       => $this->faker->randomFloat(1, 4),
            "conversion_fee"    => $this->faker->randomFloat(1, 4),
            "new_amount"        => $this->faker->randomFloat(1, 4),
            "quotation"         => $this->faker->randomFloat(1, 4),
            "amount_converted"  => $this->faker->randomFloat(1, 4),
        ];
    }
}
