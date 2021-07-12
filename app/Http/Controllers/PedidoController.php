<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Carrinho;
use App\Models\Produto;
use Illuminate\Support\Facades\DB;
class PedidoController extends Controller
{

    public function index()
    {
        $produtos = Produto::simplePaginate(5);
        $carrinho = Carrinho::where('user_id', auth()->id())->get();
        return view('loja.index', compact('produtos','carrinho'));
    }

    public function meusPedidos()
    {
        $pedidos = Pedido::where('user_id', auth()->id())->simplePaginate(5);
        $carrinho = Carrinho::where('user_id', auth()->id())->get();

        return view('loja.meus-pedidos', compact(['pedidos','carrinho']));
    }

    public function meusPedidosDetalhes(Request $request)
    {
        $pedidos = Pedido::find($request->id);
        
        return view('loja.meus-pedidos-detalhes',compact('pedidos'));
    }

    public function inserirProdutoCarrinho(Request $request)
    {
        Carrinho::create(['user_id' => auth()->id(),
                          'produto_id' => $request->produto_id,
                          'quantidade' => 1]);

        return ('Item adicionado ao carrinho');
    }

    public function alterarQuantidadeProdutoCarrinho(Request $request)
    {
        $carrinho = Carrinho::find($request->id);
        $carrinho->quantidade = $request->quantidade;
        $carrinho->save();
    }

    public function excluirProdutoCarrinho(Request $request)
    {
        $carrinho = Carrinho::find($request->id);
        $carrinho->delete();
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

        try{
            DB::transaction(function () use ($carrinho) {

                $pedido = Pedido::create(['user_id' => auth()->id()]);
            
                foreach ($carrinho as $carrinhoProduto)
                {
                
                    $pedido->produtos()->attach($carrinhoProduto->produto_id, ['quantidade' => $carrinhoProduto->quantidade,
                        'valor' => $carrinhoProduto->produto->valor]);
    
                    Produto::find($carrinhoProduto->produto_id)->decrement('quantidade',$carrinhoProduto->quantidade);
                }
    
                $pedido->status = 'Pago';
                $pedido->save();
    
                Carrinho::where('user_id', auth()->id())->delete();
    
            });
    
            return 'Compra finalizada com sucesso';

        } catch(\Exception $exception) {
            return 'Falha ao finalizar a compra';
        }
    }

    public function cancelarPedido()
    {
        
        $carrinho = Carrinho::with('produto')
                    ->where('user_id', auth()->id())
                    ->get();

        try{
            DB::transaction(function () use ($carrinho) {

                $pedido = Pedido::create(['user_id' => auth()->id()]);
            
                foreach ($carrinho as $carrinhoProduto)
                {
                
                    $pedido->produtos()->attach($carrinhoProduto->produto_id, ['quantidade' => $carrinhoProduto->quantidade,
                        'valor' => $carrinhoProduto->produto->valor]);
                }
    
                $pedido->status = 'Cancelado';
                $pedido->save();
    
                Carrinho::where('user_id', auth()->id())->delete();
    
            });
    
            return 'Pedido cancelado';

        } catch(\Exception $exception) {
            return 'Falha ao finalizar a compra';
        }
    }
}
