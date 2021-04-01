<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Pedidos;
class PedidosController extends Controller
{
    public function index()
    {
        
        $pedidos = DB::table('pedidos')
        ->leftJoin('pedido_items', 'pedidos.id', '=', 'pedido_items.id_pedido')
        ->select('pedidos.id','pedidos.id_cliente', 'pedidos.id_usuario', 'pedidos.status',DB::raw('SUM(valor_item*quantidade) as valor_bruto_total'))
        ->groupBy('pedidos.id','pedidos.id_cliente', 'pedidos.id_usuario', 'pedidos.status')
        ->get();
     
        return view('pedidos.list',['produto'=> $pedidos]);
    }
    
    public function create()
    {
        $clientes = \App\Models\Clientes::all();
        return view('pedidos.create',['clientes'=> $clientes]);
    }
    
    public  function  store(Request $request)
    {
       
     $id_insert =   \App\Models\Pedidos::create([
            'id_cliente' => $request->id_cliente,
            'id_usuario' => Auth::id(),
            'status' => "Aberto",
        ]);
        
     return redirect('pedidos/itens/'.$id_insert['id']);
    }

    
    public  function  update(Request $request)
    {
        
        $itens_retorno = $request->input();
   
       foreach($itens_retorno['id_item'] as $id_itens)
        {
            \App\Models\Pedido_item::updateOrInsert(
                        ['id_pedido' => $itens_retorno['id_pedido'], 'id_item' => $id_itens],
                        ['quantidade' => $request['qtd_item'][$id_itens],'valor_item' => $request['valor_item'][$id_itens],'desconto' => $request['desconto_item'][$id_itens]],
                        );
         
            
        }
        
        $pedido = \App\Models\Pedidos::findOrFail($itens_retorno['id_pedido']);
        $pedido->update([
            'status' => $itens_retorno['status'],
        ]);
        
        return redirect('pedidos/concluido');
    }

    
    public function destroy($id)
    {
        $pedido = \App\Models\Pedidos::findOrFail($id);
        $pedido->delete();
        DB::table('pedido_items')->where('id_pedido', '=', $id)->delete();
        return redirect('pedidos');
    }
    
    public function itens($id)
    {
        $produto = \App\Models\Produto::all();
        $pedido = \App\Models\Pedidos::findOrFail($id);
        $cliente_info = DB::table('clientes')
        ->where('id', '=', $pedido->id_cliente)
        ->get();
        return view('pedidos.itens',['produto'=> $produto,'id'=>$id,'pedido'=>$pedido,'cliente'=>$cliente_info]);
    }
    
    public function edit($id)
    {
        $produto = \App\Models\Produto::all();
        $pedido = \App\Models\Pedidos::findOrFail($id);
        $cliente_info = DB::table('clientes')
        ->where('id', '=', $pedido->id_cliente)
        ->get();
        return view('pedidos.edit',['produto'=> $produto,'id'=>$id,'pedido'=>$pedido,'cliente'=>$cliente_info]);
    }
    
    public function list()
    {
        $pedidos = DB::table('pedidos')
        ->Join('clientes', 'pedidos.id_cliente', '=', 'clientes.id')
        ->leftJoin('pedido_items', 'pedidos.id', '=', 'pedido_items.id_pedido')
        ->select('pedidos.id','pedidos.id_cliente', 'pedidos.id_usuario', 'pedidos.status',DB::raw('SUM(valor_item*quantidade) as valor_bruto_total'),'clientes.nome_cliente')
        ->groupBy('pedidos.id','pedidos.id_cliente', 'pedidos.id_usuario', 'pedidos.status','clientes.nome_cliente')
        ->get();
        
        
        return view('pedidos.list',['produto'=> $pedidos]);
    }
    
    public  function  store_itens(Request $request)
    {
        $itens_retorno = $request->input();
        
      foreach($itens_retorno['id_item'] as $id_itens)
        {
            if($request['qtd_item'][$id_itens] >0)
            $id_insert =   \App\Models\Pedido_item::create([
                'id_pedido' => $itens_retorno['id_pedido'],
                'id_item' => $id_itens,
                'quantidade' => $request['qtd_item'][$id_itens],
                'valor_item' => $request['valor_item'][$id_itens],
                'desconto' => $request['desconto_item'][$id_itens]?$request['desconto_item'][$id_itens]:0,
            ]);
            
         }
        
         return redirect('pedidos/concluido');
    }
    
    public function concluido()
    {
        return view('pedidos.concluido');
    }
}
