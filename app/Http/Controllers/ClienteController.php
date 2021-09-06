<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::get();

        return view('cliente.home', [
            'clientes' => $clientes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente = $request->validate([
            'nome' => ['required', 'min:3'],
            'cpf_cnpj' => ['required', 'min:9', 'unique:clientes'],
            'endereco' => ['required'],
            'numero' => ['required'],
            'cep' => ['required'],
            'bairro' => ['required'],
            'cidade' => ['required'],
            'uf' => ['required', 'min:2']
        ]);

        Cliente::create([
            'user_id' => Auth::id(),
            'nome' => $cliente['nome'],
            'cpf_cnpj' => $cliente['cpf_cnpj'],
            'endereco' => $cliente['endereco'],
            'numero' => $cliente['numero'],
            'cep' => $cliente['cep'],
            'bairro' => $cliente['bairro'],
            'cidade' => $cliente['cidade'],
            'uf' => $cliente['uf']
        ]);


        return redirect()->route('clientes.index')->with('mensagem_sucesso', 'Cliente cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return redirect()->route('clientes.index');
        }

        return view('cliente.edit', ['cliente' => $cliente]);
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

        $data = $request->validate([
            'nome' => ['required', 'min:3'],
            'cpf_cnpj' => ['required', 'min:9'],
            'endereco' => ['required'],
            'numero' => ['required'],
            'cep' => ['required'],
            'bairro' => ['required'],
            'cidade' => ['required'],
            'uf' => ['required', 'min:2']
        ]);

        $cliente->nome = $data['nome'];
        $cliente->cpf_cnpj = $data['cpf_cnpj'];
        $cliente->endereco = $data['endereco'];
        $cliente->numero = $data['numero'];
        $cliente->cep = $data['cep'];
        $cliente->bairro = $data['bairro'];
        $cliente->cidade = $data['cidade'];
        $cliente->uf = $data['uf'];

        $cliente->save();

        return redirect()->route('clientes.index');
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

        $cliente = Cliente::with('pedidoCompra')->find($id);
        $clientes = Cliente::with('pedidoCompra')->findMany($ids);

        // Verificar se o cliente já algum pedido
        if ($cliente) {
            if (count($cliente->pedidoCompra) > 0) {
                session()->flash('mensagem_error', 'Não foi possevel excluir, existe ' . count($cliente->pedidoCompra) . ' venda registrado com esse cliente.');
                return redirect()->route('clientes.index');
            }
            $cliente->delete();
            return redirect()->route('clientes.index');
        }

        // Exclusão em massa
        if ($clientes->count() > 0) {
            $response = null;

            foreach ($clientes as $cliente) {
                // verificar se já tem venda registrado para esse cliente.
                if ($cliente->pedidoCompra->count() > 0) {
                    $response .= '<li>Não foi possivel excluir o produto <b>' . $cliente->nome . '</b>, existe ' . count($cliente->pedidoCompra) . ' venda registrado.</li>';
                } else {
                    // Excluir cliente caso não tem venda registrada para o mesmo.
                    $cliente->delete();
                }
            }
            return response()->json($response);
        }
    }
}
