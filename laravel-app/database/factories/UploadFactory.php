<?php

namespace Database\Factories;

use App\Models\Upload;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Upload>
 */
class UploadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Upload::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'original_name' => $this->faker->word() . '.csv',
            'file_name' => Str::random(40) . '.csv',
            'file_path' => 'uploads/' . Str::random(40) . '.csv',
            'file_hash' => md5($this->faker->sentence()),
            'status' => $this->faker->randomElement(['pending', 'processing', 'completed', 'failed']),
            'reference_date' => $this->faker->date(),
            'processed_at' => $this->faker->optional()->dateTime(),
            'total_records' => $this->faker->numberBetween(10, 1000),
            'error_message' => $this->faker->optional()->sentence(),
        ];
    }

    /**
     * Indicate that the upload is completed.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function completed()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'completed',
                'processed_at' => now(),
                'error_message' => null,
            ];
        });
    }

    /**
     * Indicate that the upload has failed.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function failed()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'failed',
                'processed_at' => now(),
                'error_message' => 'Error processing file: invalid format',
            ];
        });
    }
} 