<?php

namespace App\Http\Controllers\Api;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ClienteResource;

class ClienteController extends Controller
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
        $cliente = Cliente::paginate(10);
        return ClienteResource::collection($cliente);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => ['required', 'min:3'],
            'cpf_cnpj' => ['required', 'min:9', 'unique:clientes'],
            'endereco' => ['required'],
            'numero' => ['required'],
            'cep' => ['required'],
            'bairro' => ['required'],
            'cidade' => ['required'],
            'uf' => ['required', 'min:2']
        ]);

        $cliente = Cliente::create([
            'user_id' => Auth::id(),
            'nome' => $request->nome,
            'cpf_cnpj' => $request->cpf_cnpj,
            'endereco' => $request->endereco,
            'numero' => $request->numero,
            'cep' => $request->cep,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
            'uf' => $request->uf
        ]);

        return new ClienteResource($cliente);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = Cliente::find($id);
        if ($cliente) {
            return new ClienteResource($cliente);
        }

        return response()->json(['error' => 'Cliente não encontrado.']);
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
        $cliente = Cliente::find($id);

        if ($cliente) {

            $request->validate([
                'nome' => ['required', 'min:3'],
                'cpf_cnpj' => ['required', 'min:9', 'integer'],
                'endereco' => ['required'],
                'numero' => ['required'],
                'cep' => ['required'],
                'bairro' => ['required'],
                'cidade' => ['required'],
                'uf' => ['required', 'min:2']
            ]);

            $cliente->nome = $request->nome;
            $cliente->cpf_cnpj = $request->cpf_cnpj;
            $cliente->endereco = $request->endereco;
            $cliente->numero = $request->numero;
            $cliente->cep = $request->cep;
            $cliente->bairro = $request->bairro;
            $cliente->cidade = $request->cidade;
            $cliente->uf = $request->uf;
            $cliente->save();

            return new ClienteResource($cliente);
        }

        return response()->json(['error' => 'Cliente não encontrado.']);
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

        $clientes  = Cliente::with('pedidoCompra')->findMany($ids);

        if ($clientes->count() > 0) {
            $response = [];

            foreach ($clientes as $cliente) {
                // verificar se já tem venda registrado para esse cliente.
                if ($cliente->pedidoCompra->count() > 0) {
                    $response['error'][] = 'Não foi possivel excluir o produto <b>' . $cliente->nome . '</b>, existe ' . count($cliente->pedidoCompra) . ' venda registrado.';
                } else {
                    // Excluir cliente caso não tem venda registrada para o mesmo.
                    $cliente->delete();
                }
            }

            return response()->json($response);
        }


        return response()->json(['error' => 'Cliente não encontrado.']);
    }
}
