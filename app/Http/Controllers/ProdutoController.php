<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdutoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::get();

        return view('produto.home', [
            'produtos' => $produtos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produto.create');
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
        $produto = $request->validate([
            'descricao' => ['required', 'min:2'],
            'estoque' => ['required'],
            'preco' => ['required'],
        ]);

        // Format o preco
        $preco = Str::of($produto['preco'])->remove('.')->replace(',', '.');

        // Salva o produto
        Produto::create([
            'descricao' => $produto['descricao'],
            'estoque' => $produto['estoque'],
            'preco' => $preco
        ]);


        return redirect()->route('produtos.index');
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
        $produto = Produto::find($id);

        if (!$produto) {
            return redirect()->route('produtos.index');
        }

        return view('produto.edit', ['produto' => $produto]);
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

        $data = $request->validate([
            'descricao' => ['required', 'min:2'],
            'estoque' => ['required'],
            'preco' => ['required'],
        ]);


        $preco = Str::of($data['preco'])->remove('.')->replace(',', '.');
        $produto->update([
            'descricao' => $data['descricao'],
            'estoque' => $data['estoque'],
            'preco' => $preco
        ]);

        return redirect()->route('produtos.index');
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

        $produto  = Produto::with('itensPedidosCompras')->find($id);
        $produtos = Produto::with('itensPedidosCompras')->findMany($ids);

        // Verificar se exite uma veda ristrada com esse produto
        if ($produto) {
            if ($produto->itensPedidosCompras->count() > 0) {
                session()->flash('mensagem_error', 'Não foi possivel excluir o produto: ' . $produto->descricao . ', existe ' . count($produto->itensPedidosCompras) . ' venda registrado.');
                return redirect()->route('produtos.index');
            }
            $produto->delete();
            return redirect()->route('produtos.index');
        }

        // Exclusão em massa
        if ($produtos->count() > 0) {
            $response = null;
            foreach ($produtos as $produto) {
                // verificar se já tem venda registrado para esse cliente.
                if ($produto->itensPedidosCompras->count() > 0) {
                    $response .= '<li>Não foi possivel excluir o produto <b>' . $produto->descricao . '</b>, existe ' . count($produto->itensPedidosCompras) . ' venda registrado.</li>';
                } else {
                    // Excluir cliente caso não tem venda registrada para o mesmo.
                    $produto->delete();
                }
            }
            return response()->json($response);
        }
    }

}
