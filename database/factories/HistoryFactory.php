<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\History;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<History>
 */
class HistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $payment = Payment::select('id')->get();
        $user = User::select('id')->get();

        return [
            'origin_currency' => $this->faker->currencyCode(),
            'destiny_currency' => $this->faker->currencyCode(),
            'conversion_amount' => $this->faker->randomFloat(4, 2, 4),
            'amount_destination_currency' => $this->faker->randomFloat(4, 2, 4),
            'amount_currency_purchased' => $this->faker->randomFloat(4, 2, 4),
            'amount_used_conversion' => $this->faker->randomFloat(4, 2, 4),
            'payment_rate' => $this->faker->randomFloat(4, 2, 4),
            'conversion_rate' => $this->faker->randomFloat(4, 2, 4),
            'payment_id' => $payment->isEmpty() ? Payment::factory()->create() : $payment->random(),
            'user_id' => $user->isEmpty() ? User::factory()->create() : $user->random(),
        ];
    }
}
