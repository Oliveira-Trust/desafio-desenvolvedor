<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'document'                  =>  $this->faker->numerify('###.###.###-##'),
            'phone_number'              =>  $this->faker->numerify('(##) ####-####'),
            'phone_number2'             =>  $this->faker->numerify('(##) #####-####'),
            'birth'                     =>  $this->faker->dateTimeBetween('-30 years', '-20 years')->format('Y-m-d'),
            'address_zipcode'           =>  $this->faker->numerify('##.###-###'),
            'address_street'            =>  $this->faker->streetName(),
            'address_number'            =>  $this->faker->randomNumber(5, false),
            'address_complement'        =>  $this->faker->sentence(3),
            'address_neighborhood'      =>  $this->faker->word(),
            'city_id'                   =>  $this->faker->numberBetween(1, 5565),
        ];
    }
}
