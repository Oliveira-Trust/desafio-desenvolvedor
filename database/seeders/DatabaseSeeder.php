<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Cliente;
use App\Models\Produto;
use App\Models\PedidosCompra;
use Illuminate\Database\Seeder;
use App\Models\ItensPedidosCompra;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create();

        $cliente = Cliente::factory()->create([
            'user_id' => $user->id
        ]);
    
        $pedidoCompra = PedidosCompra::factory()->create([
            'user_id' => $user->id,
            'cliente_id' => $cliente->id
        ]);
    
        $produtos = Produto::factory(5)->create();

        // Registra 5 produto no pedido de compra.
        foreach($produtos as $produto) {
            ItensPedidosCompra::factory()->create([
                'pedido_compra_id' => $pedidoCompra->id,
                'produto_id' => $produto->id
            ]);
        }
        
    }
}
