<?php

namespace App\Http\Controllers\Api;

use App\Models\Produto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProdutoResource;

class ProdutoController extends Controller
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
        $produtos = Produto::paginate(10);
        return ProdutoResource::collection($produtos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Valida os dados
        $data = $request->validate([
            'descricao' => ['required', 'min:2'],
            'estoque' => ['required'],
            'preco' => ['required'],
        ]);

        // Salva o produto
        $produto = Produto::create($data);

        return new ProdutoResource($produto);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produto = Produto::find($id);
        if ($produto) {
            return new ProdutoResource($produto);
        }

        return response()->json(['error' => 'Produto não encontrado.']);
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
        $produto = Produto::find($id);

        $request->validate([
            'descricao' => ['required', 'min:2'],
            'estoque' => ['required'],
            'preco' => ['required'],
        ]);

        $produto->update([
            'descricao' => $request->descricao,
            'estoque' => $request->estoque,
            'preco' => $request->preco
        ]);

        return new ProdutoResource($produto);
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

        $produtos = Produto::with('itensPedidosCompras')->findMany($ids);

        if ($produtos->count() > 0) {
            $response = [];

            foreach ($produtos as $produto) {
                // verificar se já tem venda registrado para esse cliente.
                if ($produto->itensPedidosCompras->count() > 0) {
                    $response['error'][] = 'Não foi possivel excluir o produto <b>' . $produto->descricao . '</b>, existe ' . count($produto->itensPedidosCompras) . ' venda registrado.';
                } else {
                    // Excluir cliente caso não tem venda registrada para o mesmo.
                    $produto->delete();
                }
            }

            return response()->json($response);
        }

        return response()->json(['error' => 'Produto não encontrado.']);
    }
}
