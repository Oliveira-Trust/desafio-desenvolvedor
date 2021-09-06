<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Cliente;
use App\Models\Produto;
use Illuminate\Http\Request;
use App\Models\PedidosCompra;
use App\Models\ItensPedidosCompra;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PedidoCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = PedidosCompra::with(['user', 'cliente'])->get();

        return view('pedido_compra.home', [
            'pedidos' => $pedidos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Cliente::get();
        $produtos = Produto::get();
        $user = Auth::user();

        return view('pedido_compra.create', [
            'clientes' => $clientes,
            'produtos' => $produtos,
            'user' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = [];
        $data = $request->only([
            'clienteId',
            'valorTotal',
            'status',
            'itensPedido'
        ]);

        $validator = Validator::make($data, [
            'clienteId' => ['required'],
            'valorTotal' => ['required'],
            'status' => ['required'],
            'itensPedido' => ['required']
        ]);

        if (!$validator->fails()) {
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
                $response['sucesso'] = "Pedidos cadastrado com sucesso";
                $response['redirect'] = route('pedidos.index');
            } catch (Exception $error) {
                $response['error'] = "Erro: " . $error;
            }
        } else {
            $response['error'] = "Preencha todos os campos.";
        }

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $itens = ItensPedidosCompra::with('produto')->where('pedido_compra_id', $id)->get();
        return response()->json($itens);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clientes = Cliente::get();
        $produtos = Produto::get();
        $pedido = PedidosCompra::with(['user', 'cliente', 'itensPedidosCompra'])->find($id);

        return view('pedido_compra.edit', [
            'clientes' => $clientes,
            'produtos' => $produtos,
            'pedido' => $pedido
        ]);
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
        $response = [];

        $data = $request->only([
            'clienteId',
            'valorTotal',
            'status',
            'itensPedido'
        ]);

        $validator = Validator::make($data, [
            'clienteId' => ['required'],
            'valorTotal' => ['required'],
            'status' => ['required'],
            'itensPedido' => ['required']
        ]);

        if (!$validator->fails()) {

            try {

                // Update do pedido
                $pedidoCompra = PedidosCompra::find($id);
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

                $response['sucesso'] = "Pedidos Atualizado com sucesso";
                $response['redirect'] = route('pedidos.index');
            } catch (Exception $e) {
                $response['error'] = "Erro ao Atualizar o pedido";
            }
        } else {
            $response['error'] = "Preencha todos os campos.";
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
        $ids = $data['ids'] ?? null;

        $pedido = PedidosCompra::find($id);

        if ($pedido) {
            PedidosCompra::destroy($id);
            return redirect()->route('pedidos.index');
        }
        if ($ids) {
            PedidosCompra::destroy($ids);
            return response()->json(['sucesso' => 'Pedidos excluidos.']);
        }

        return response()->json(['error' => 'Pedido não encontrado']);
    }
}
