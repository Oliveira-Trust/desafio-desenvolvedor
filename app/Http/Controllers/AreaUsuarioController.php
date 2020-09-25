<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Services\AreaUsuarioService;

class AreaUsuarioController extends Controller
{
    private $areaUsuarioService;

    public function __construct()
    {
        $this->middleware('auth');
        $this->areaUsuarioService = new AreaUsuarioService();
    }

    public function manter(Request $request)
    {
        if(!Auth::check()){
            return redirect()->route('login')->with('success', $this->msgErro);
        }

        return view('areaUsuario.manter'); 
    }

    public function alterarDadosCadastrais(Request $request)
    {
        if($request->isMethod('post')){
            try {
                $this->areaUsuarioService->alterarDadosCadastrais($request);
                return redirect()->route('areaUsuario')->with('success', $this->msgSucesso);
            }catch(Exception $e){
                return view('error.500');
            }
        }else {
            return view('areaUsuario.manter'); 
        }
    }

    public function alterarSenha(Request $request)
    {
        if($request->isMethod('post')){
            try {
                $this->areaUsuarioService->alterarSenha($request);
                return redirect()->route('areaUsuario')->with('success', $this->msgSucesso);
            }catch(Exception $e){
                return view('error.500');
            }
        }else {
            return view('error.500');
        }
    }
}