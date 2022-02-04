<?php

namespace App\Http\Controllers\Gerencial;

use App\Http\Controllers\Controller;
use App\Http\Models\FormaPagamentoTaxa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Auth;
use Facade\FlareClient\Stacktrace\File;

class FormaPagamentoTaxasController extends Controller{
    protected $modulo = 'gerencial';
    protected $entidade = 'forma_pagamento_taxas';
    /**
     * Listar Meios de pagamento
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $objFormaPagamentoTaxa =  new FormaPagamentoTaxa();
        $condicoes = [];
        $condicoes[] = ['forma_pagamento_taxas.empresa_id', '=', Auth::user()->empresa_id];
        
        $formaPagamentoTaxas = $objFormaPagamentoTaxa->listaPaginacao($condicoes);
        // dd($formaPagamentoTaxas);
        unset($objFormaPagamentoTaxa);
        return view($this->modulo.'.'.$this->entidade.'.index',compact('formaPagamentoTaxas'))
               ->with('i', (request()->input('page', 1) - 1) * 4);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function editar($id, $aba = 1){
        $objFormaPagamentoTaxa = new FormaPagamentoTaxa();
        $formaPagamentoTaxa = $objFormaPagamentoTaxa->buscarPorId( $id );
        if(empty( $formaPagamentoTaxa )  ){
            return redirect()->route($this->entidade.'.index')
                    ->withInput()
                    ->withErrors([
                        'error' => 'Você não tem permissão para acessar esta área.',
                    ]);
        }
        unset( $objFormaPagamentoTaxa );
        return view($this->modulo.'.'.$this->entidade.'.editar',compact('formaPagamentoTaxa', 'aba'));
    }
    /**
     * Atualizar a forma de pagamento
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function atualizar(Request $request, $id){
        $objFormaPagamentoTaxa =  new FormaPagamentoTaxa();
        $formaPagamentoTaxa = $objFormaPagamentoTaxa->buscarPorId( $id );
        if(empty( $formaPagamentoTaxa )  ){
            return redirect()->route($this->entidade.'.index')
                    ->withInput()
                    ->withErrors([
                        'error' => 'Você não tem permissão para acessar esta área.',
                    ]);
        }
        $request->offsetSet('porcentagem', str_replace('%', '',$request->porcentagem));
        $request->offsetSet('porcentagem', str_replace(',', '',$request->porcentagem));
        $request->request->add(['porcentagem' => floatval($request->porcentagem)]);
        $request->validate([
            'porcentagem' => ['required']
        ]);        
        $formaPagamentoTaxa->atualizar($request->all());
        unset($objFormaPagamentoTaxa);
        return redirect()->route($this->entidade.'.index', [$formaPagamentoTaxa->id,2])
                        ->with('success','Taxa de Forma de pagamento atualizada com sucesso!');
    }
}
