<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\PedidosCompra;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PedidosCompraFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PedidosCompra::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'user_id' => User::factory(),
            // 'cliente_id' => Cliente::factory(),
            'valor_total' => $this->faker->randomFloat(2, 1, 500),
            'status' => 'Em Aberto'
        ];
    }
}

