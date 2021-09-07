<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Models\PedidosCompra;
use App\Models\ItensPedidosCompra;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PedidoCompraResource;

class PedidoCompraController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = PedidosCompra::with(['user', 'cliente', 'itensPedidosCompra'])->paginate(10);
        return PedidoCompraResource::collection($pedidos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'clienteId' => ['required'],
            'valorTotal' => ['required'],
            'status' => ['required'],
            'itensPedido' => ['required']
        ]);

        try {

            $pedidoCompra = PedidosCompra::create([
                'user_id' => Auth::id(),
                'cliente_id' => $data['clienteId'],
                'valor_total' => $data['valorTotal'],
                'status' => $data['status']
            ]);
            foreach ($data['itensPedido'] as $item) {
                ItensPedidosCompra::create([
                    'pedido_compra_id' => $pedidoCompra->id,
                    'produto_id' => $item['id'],
                    'quantidade' => $item['quantidade'],
                    'preco' => $item['preco']
                ]);
            }
        } catch (Exception $error) {
            return response()->json(['error' => "Erro ao cadastrar: " . $error->getMessage()]);
        }

        return new PedidoCompraResource($pedidoCompra);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pedido = PedidosCompra::with(['user', 'cliente', 'itensPedidosCompra'])->find($id);
        if ($pedido) {
            return new PedidoCompraResource($pedido);
        }

        return response()->json(['error' => 'Pedido não encontrado.']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pedidoCompra = PedidosCompra::find($id);

        $data =  $request->validate([
            'clienteId' => ['required'],
            'valorTotal' => ['required'],
            'status' => ['required'],
            'itensPedido' => ['required']
        ]);

        if ($pedidoCompra) {
            try {

                // Update do pedido
                $pedidoCompra->cliente_id = $data['clienteId'];
                $pedidoCompra->valor_total = $data['valorTotal'];
                $pedidoCompra->status = $data['status'];
                $pedidoCompra->save();

                // Remove todos itens anteriores
                ItensPedidosCompra::where('pedido_compra_id', $id)->delete();

                // Salva os novos itens
                foreach ($data['itensPedido'] as $item) {
                    ItensPedidosCompra::create([
                        'pedido_compra_id' => $pedidoCompra->id,
                        'produto_id' => $item['id'],
                        'quantidade' => $item['quantidade'],
                        'preco' => $item['preco']
                    ]);
                }

                return new PedidoCompraResource($pedidoCompra);
            } catch (Exception $error) {
                $response['error'] = "Erro ao Atualizar: " . $error->getMessage();
            }
        } else {
            $response['error'] = "Pedido não encontrado.";
        }

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $data = $request->all();
        $ids = $data['ids'] ?? $id;

        $pedidos = PedidosCompra::findMany($ids);
        if ($pedidos->count() > 0) {
            PedidosCompra::destroy($ids);
            return PedidoCompraResource::collection($pedidos);
        }

        return response()->json(['error' => 'Pedido(s) não localizado(s).']);
    }
}
