<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Utils\Util;

use App\Http\Services\ProdutosService;

use Redirect;

class ManterProdutosController extends Controller
{
    private $produtosService;

    public function __construct()
    {
        $this->middleware('auth');
        $this->produtosService = new ProdutosService();
    }

    public function manter(Request $request)
    {
        try {
            $produtos = $this->produtosService->obterListaInicial($request);
            return view('produtos.manter', [
                'produtos' => $produtos,
                'listaOrdenacao' => $this->produtosService->listaOrdenacao
            ])->with('success', $this->msgSucesso);
        }catch(Exception $e){
            return view('error.500');
        }
    }

    public function filtrar(Request $request)
    {
        if($request->isMethod('post')){
            try {
                $produtos = $this->produtosService->filtrar($request);
                return view('produtos.manter', [
                    'produtos' => $produtos,
                    'listaOrdenacao' => $this->produtosService->listaOrdenacao,
                    'campos' => $request->all()
                ])->with('success', $this->msgSucesso);
            }catch(Exception $e){
                return view('error.500');
            }
        }else {
            return view('produtos.manter'); 
        }
    }

    public function salvar(Request $request)
    {
        try {
            $this->produtosService->salvar($request);
            return redirect()->route('manterProdutos')->with('success', $this->msgSucesso);
        }catch(Exception $e){
            return view('error.500');
        }
    }

    public function inativar($id)
    {
        try {
            $this->produtosService->inativar($id);
            return redirect()->route('manterProdutos')->with('success', $this->msgSucesso);
        }catch(Exception $e){
            return view('error.500');
        }
    }

    public function obterPorId($id)
    {
        return response()->json($this->produtosService->obterPorId($id));
    }

    public function inativarProdutosMarcados(Request $request)
    {
        try {
            $this->produtosService->inativarProdutosMarcados($request);
            return redirect()->route('manterProdutos')->with('success', $this->msgSucesso);
        }catch(Exception $e){
            return view('error.500');
        }
    }
}