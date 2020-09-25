<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Utils\Util;

use App\Http\Services\ClientesService;

use Redirect;

class ManterClientesController extends Controller
{
    private $clientesService;

    public function __construct()
    {
        $this->middleware('auth');
        $this->clientesService = new ClientesService();
    }

    public function manter(Request $request)
    {
        try {
            $clientes = $this->clientesService->obterListaInicial($request);
            return view('clientes.manter', [
                'clientes' => $clientes,
                'listaOrdenacao' => $this->clientesService->listaOrdenacao
            ])->with('success', $this->msgSucesso);
        }catch(Exception $e){
            return view('error.500');
        }
    }

    public function filtrar(Request $request)
    {
        if($request->isMethod('post')){
            try {
                $clientes = $this->clientesService->filtrar($request);
                return view('clientes.manter', [
                    'clientes' => $clientes,
                    'listaOrdenacao' => $this->clientesService->listaOrdenacao,
                    'campos' => $request->all()
                ])->with('success', $this->msgSucesso);
            }catch(Exception $e){
                return view('error.500');
            }
        }else {
            return view('clientes.manter'); 
        }
    }

    public function salvar(Request $request)
    {
        try {
            $this->clientesService->salvar($request);
            return redirect()->route('manterClientes')->with('success', $this->msgSucesso);
        }catch(Exception $e){
            return view('error.500');
        }
    }

    public function inativar($id)
    {
        try {
            $this->clientesService->inativar($id);
            return redirect()->route('manterClientes')->with('success', $this->msgSucesso);
        }catch(Exception $e){
            return view('error.500');
        }
    }

    public function obterPorId($id)
    {
        return response()->json($this->clientesService->obterPorId($id));
    }

    public function inativarClientesMarcados(Request $request)
    {
        try {
            $this->clientesService->inativarClientesMarcados($request);
            return redirect()->route('manterClientes')->with('success', $this->msgSucesso);
        }catch(Exception $e){
            return view('error.500');
        }
    }
}