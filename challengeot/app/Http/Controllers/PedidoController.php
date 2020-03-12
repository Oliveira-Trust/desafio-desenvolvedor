<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\Cliente;
use App\Models\ProdutoPedido;
use DB;

class PedidoController extends Controller
{
    protected $pedido;

    public function __construct(Pedido $pedido, Produto $produto, Cliente $cliente, ProdutoPedido $produtopedido)
    {
        $this->pedido = $pedido;
        $this->produto = $produto;
        $this->cliente = $cliente;
        $this->produtopedido = $produtopedido;
    }

    public function pedidoPage(){
        $pedido = $this->pedido->all();
        $produto = $this->produto->all();
        $cliente = $this->cliente->all();
        return view('pedidos', compact('pedido', 'produto', 'cliente'));
    }

    public function pedidosGet(){
        $pedido = $this->pedido->all();
    }

    public function pedidoGet($id){
        $pedido = $this->pedido->findOrFail($id);
    }

    public function pedidoCreate(Request $request){


        DB::transaction(function() use ($request){
            $produto = $this->produto->all();

            $pedido = $this->pedido->create([
                'cliente_id' => $request->cliente,
                'status'     => $request->status
            ]);

            foreach($produto as $produto){
    
                if($request['produto_'.$produto->id] > 0 && !!$request['produto_'.$produto->id]){
                    
                    $produtopedido = $this->produtopedido->create([
                        'pedido_id'  => $pedido->id,
                        'produto_id' => $produto->id,
                        'quantidade' => $request['produto_'.$produto->id]
                    ]);
                }
            }

        });

        return redirect(route('pedidos'));
    }
    public function pedidoUpdate($id, Request $request){

        $pedido = $this->pedido->findOrFail($id);

        DB::transaction(function() use ($pedido, $request){
            $produto = $this->produto->all();

            $pedido->update(['cliente_id' => $request->cliente]);

            foreach($produto as $produto){

                $produtopedido = $this->produtopedido->where('pedido_id', $pedido->id)->where('produto_id', $produto->id)->first();
    
                if($produtopedido){
                    if(!$request['produto_'.$produto->id]){
                        $produtopedido->delete();
                    }
                    else{
                        $produtopedido->update(['quantidade' => $request['produto_'.$produto->id]]);
                    }
                }
                else if($request['produto_'.$produto->id] > 0 && !!$request['produto_'.$produto->id]){

                    $produtopedido = $this->produtopedido->create([
                        'pedido_id'  => $pedido->id,
                        'produto_id' => $produto->id,
                        'quantidade' => $request['produto_'.$produto->id]
                    ]);
                }
            }
        });

        return redirect(route('pedidos'));
    }
    public function pedidoDelete($ids){

        $ids_pedido = explode(',',$ids);
        
        DB::transaction(function() use ($ids_pedido){
            foreach($ids_pedido as $id){
                $atualpedido = $this->pedido->findOrFail($id);

                $atualpedido->delete();
            }
        });
        return redirect(route('pedidos'));
    }
}
