<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Client;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Models\OrderProduct;
use App\Repositories\OrderProductRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;

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
        $categories = Category::all();
        $clients = Client::all()->load('user');
        return view('admin.pedidos.create', compact('categories', 'clients'));
    }

    /**
     * Cadastra um novo pedido.
     *
     * @param  OrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request, ProductRepository $model, OrderRepository $orderRepository, OrderProductRepository $orderProductRepository)
    {
        //  pega o valor de cada produto e multiplica pela sua quantidade solicitada e retorna o valor total que será o pedido
        try {
            $total = $model->calculateTotal($request->all());
             // Com esse total, cria o pedido
            try {
                $order = $orderRepository->createFromData($request->all(), $total);
        
                // Adiciona os produtos nesse novo pedido
                try {
                    $orderProductRepository->createFromData($request->all(), $order->id);
                } catch (\Throwable $th) {
                    $order->delete(); // em caso de erro, deleta o pedido e informa
                    return response()->json([ 'status' => false, 'message' => 'Falha ao finalizar o pedido. Revise os dados e tente novamente.', 'th' => $th, 'code' => 'step 3'], 400);
                }
                return response()->json([ 'status' => true, 'message' => 'Registro adicionado com sucesso!'], 200);
            } catch (\Throwable $th) {
                return response()->json([ 'status' => false, 'message' => 'Falha ao finalizar o pedido. Revise os dados e tente novamente.', 'th' => $th, 'code' => 'step 2'], 400);
            }
        } catch (\Throwable $th) {
            return response()->json([ 'status' => false, 'message' => 'Falha ao finalizar o pedido. Revise os dados e tente novamente.', 'th' => $th, 'code' => 'step 1'], 400);
        }
    }

    
    /**
     * Exibe a página para visualizar o pedido.
     *
     * @param  Order  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Order $pedido){
        /* $pedido = $pedido->load(
                                'orderproduct', 
                                'orderproduct.product', 
                                'orderproduct.product.category', 
                                'client', 
                                'client.user'); */
        return view('admin.pedidos.show', compact('pedido'));
    }


    /**
     * Exibe a página para editar o pedido.
     *
     * @param  Order  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $pedido)
    {
        $clients = Client::all()->load('user');
        $pedido = $pedido->load('orderproduct', 'orderproduct.product', 'orderproduct.product.category');
        return view('admin.pedidos.edit', compact('pedido',  'clients'));
    }

    /**
     * Atualiza um pedido.
     *
     * @param  OrderRequest  $request
     * @param  Order  $pedido
     * @param  ProductRepository  $model
     * @param  OrderProductRepository $orderProductRepository
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, Order $pedido, ProductRepository $model, OrderProductRepository $orderProductRepository)
    {

        // pega os IDs antigos para depois serem deletados
        $oldOrderProductsIds = $pedido->orderproduct->map(fn($item) => $item->id);
        // pega o pedido antigo como backup
        $oldOrder = $pedido;


        //  pega o valor de cada produto e multiplica pela sua quantidade solicitada e retorna o valor total que será atualizado o valor do pedido
        try {
            $total = $model->calculateTotal($request->all());
            try {
                // Com esse total, atualiza o pedido
                $pedido->total = $total;
                $pedido->update($request->only('total', 'paid_at', 'status', 'client_id'));
                
                try {
                    // atualiza com os novos itens
                    $orderProductRepository->createFromData($request->all(), $pedido->id);
                    
                    try {
                        // deleta os itens antigos
                        OrderProduct::destroy($oldOrderProductsIds);
                    } catch (\Throwable $th) {
                        return response()->json([ 'status' => false, 'message' => 'Falha ao remover os itens antigos do pedido. Revise os dados e tente novamente.', 'th' => $th, 'code' => 'step 4'], 400);
                    }
                } catch (\Throwable $th) {
                    // retorna os dados antigos
                    $pedido->status     =   $oldOrder->status;
                    $pedido->paid_at    =   $oldOrder->paid_at;
                    $pedido->total      =   $oldOrder->total;
                    $pedido->client_id  =   $oldOrder->client_id;
                    $pedido->save();
                    return response()->json([ 'status' => false, 'message' => 'Falha ao atualizar o pedido. Revise os dados e tente novamente.', 'th' => $th, 'code' => 'step 3'], 400);
                }
                return response()->json([ 'status' => true, 'message' => 'Registro atualiado com sucesso!'], 200);
            } catch (\Throwable $th) {
                return response()->json([ 'status' => false, 'message' => 'Falha ao atualizar o pedido. Revise os dados e tente novamente.', 'th' => $th, 'code' => 'step 2'], 400);
            }
        } catch (\Throwable $th) {
            return response()->json([ 'status' => false, 'message' => 'Falha ao atualizar o pedido. Revise os dados e tente novamente.', 'th' => $th, 'code' => 'step 1'], 400);
        }
    }

    /**
     * Remove um pedido.
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
     * Pesquisa e pagina os registros de pedidos.
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
