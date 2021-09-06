<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\User;
use App\Models\ItensPedidosCompra;
use App\Models\PedidosCompra;
use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItensPedidosCompraFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ItensPedidosCompra::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'pedido_compra_id' => PedidosCompra::factory(),
            // 'produto_id' => Produto::factory(),
            'quantidade' => $this->faker->randomNumber(2),
            'preco' => $this->faker->randomFloat(4, 1, 100)
        ];
    }
}

