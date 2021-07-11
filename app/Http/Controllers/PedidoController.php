<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\PedidoDetalhe;
use App\Models\Carrinho;
use App\Models\Produto;

class PedidoController extends Controller
{

    public function inserirProdutoCarrinho(Request $request)
    {
        Carrinho::create(['user_id' => auth()->id(),
                          'produto_id' => $request->produto_id,
                          'quantidade' => 1]);

        return ('Item adicionado ao carrinho');
    }

    public function checkoutPedido()
    {
        $carrinho = Carrinho::with('produto')
                    ->where('user_id', auth()->id())
                    ->get();

        $produtos = Produto::select('id','quantidade')
                    ->whereIn('id',$carrinho->pluck('produto_id'))
                    ->pluck('quantidade', 'id');
        
        foreach ($carrinho as $carrinhoProduto)
        {
            if (!isset($produtos[$carrinhoProduto->produto_id]) || $produtos[$carrinhoProduto->produto_id] < $carrinhoProduto->quantidade)
            {
                return $carrinhoProduto->produto->descricao.' sem estoque';
            }  
        }

        $pedido = Pedido::create(['user_id' => auth()->id()]);
        return 'ok';
    }
}