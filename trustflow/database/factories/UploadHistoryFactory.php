<?php

namespace Database\Factories;

use App\Models\UploadHistory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UploadHistory>
 */
class UploadHistoryFactory extends Factory
{
    protected $model = UploadHistory::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'file_name' => $this->faker->word() . ".csv",
            'file_hash' => $this->faker->md5(),
            'reference_date' => $this->faker->date('Y-m-d'),
            'total_rows' => 0,
            'status' => 'pending'
        ];
    }
}
