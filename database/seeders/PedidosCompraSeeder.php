<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Cliente;
use App\Models\Produto;
use App\Models\PedidosCompra;
use Illuminate\Database\Seeder;
use App\Models\ItensPedidosCompra;

class PedidosCompraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create();

        $cliente = Cliente::factory()->create([
            'user_id' => $user->id
        ]);
    
        $pedidoCompras = PedidosCompra::factory(10)->create([
            'user_id' => $user->id,
            'cliente_id' => $cliente->id
        ]);

        $produto = Produto::factory()->create();

        // Registra 10 pedido de compra com um produto.
        foreach($pedidoCompras as $pedidoCompra) {

            ItensPedidosCompra::factory()->create([
                'pedido_compra_id' => $pedidoCompra->id,
                'produto_id' => $produto->id
            ]);
            
        }

    }
}
