<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cliente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'user_id' => User::factory(),
            'nome' => $this->faker->name(),
            'cpf_cnpj' => $this->faker->randomNumber(),
            'endereco' => $this->faker->address(),
            'numero' => $this->faker->buildingNumber(),
            'cep' => $this->faker->postcode(),
            'bairro' => $this->faker->citySuffix(),
            'cidade' => $this->faker->city(),
            'uf' => $this->faker->stateAbbr()
        ];
    }
}
