<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Repositories\OrderRepository;

class OrderController extends Controller
{
    /**
     * Exibe a listagem de pedidos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pedidos.index');
    }

    /**
     * Exibe a página de criação de pedidos.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::with('category')->all();
        return view('admin.pedidos.create', compact('products'));
    }

    /**
     * Cadastra um novo pedido.
     *
     * @param  OrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        Order::create($request->only('name', 'label', 'category_id', 'value', 'description', 'enabled')); // FIXME: AJUSTAR CAMPOS
        return response()->json([ 'status' => true, 'message' => 'Registro adicionado com sucesso!'], 200);
    }

    /**
     * Exibe a página para editar o pedido.
     *
     * @param  Order  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $pedido)
    {
        $products = Product::with('category')->all();
        return view('admin.pedidos.edit', compact('pedido', 'products'));
    }

    /**
     * Atualiza um pedido.
     *
     * @param  OrderRequest  $request
     * @param  Order $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, Order $pedido)
    {
        $pedido->update($request->only('name', 'label', 'category_id', 'value', 'description', 'enabled'));   // FIXME: AJUSTAR CAMPOS
        return response()->json([ 'status' => true, 'message' => 'Registro atualizado com sucesso!'], 200);
    }

    /**
     * Remove um produto.
     *
     * @param Order $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $pedido)
    {
        $pedido->delete();
        return response()->json([ 'status' => true, 'message' => 'Registro deletado com sucesso!'], 200);
    }


    

    /**
     * Pesquisa e pagina os registros de produtos.
     *
     * @param Request $request
     * @return void
     */
    public function search(Request $request, OrderRepository $model){
        return $model->search($request->all());
    }



    public function deleteInMass(Request $request){
        try {
            Product::whereIn('id', $request->items)->delete();
            return response()->json([ 'status' => true, 'message' => count($request->items) > 1 ? 'Registros deletados com sucesso!' : 'Registro deletado com sucesso!'], 200);
        } catch (\Throwable $th) {
            return response()->json([ 'status' => false, 'message' => 'Erro ao deletar os registros.', 'th' =>  $th], 400);
        }
    }
}
