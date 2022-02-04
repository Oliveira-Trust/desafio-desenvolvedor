<?php

namespace App\Http\Controllers\Gerencial;

use App\Http\Controllers\Controller;
use App\Http\Models\ConversaoTaxa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Auth;
use Facade\FlareClient\Stacktrace\File;

class ConversaoTaxasController extends Controller{
    
    protected $modulo = 'gerencial';
    protected $entidade = 'conversao_taxas';
    /**
     * Listar Meios de pagamento
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $objConversaoTaxa =  new ConversaoTaxa();
        $condicoes = [];
        $condicoes[] = ['conversao_taxas.empresa_id', '=', Auth::user()->empresa_id];
        
        $conversaoTaxas = $objConversaoTaxa->listaPaginacao($condicoes);
        // dd($conversaoTaxas);
        unset($objConversaoTaxa);
        return view($this->modulo.'.'.$this->entidade.'.index',compact('conversaoTaxas'))
               ->with('i', (request()->input('page', 1) - 1) * 4);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function editar($id, $aba = 1){
        $objConversaoTaxa = new ConversaoTaxa();
        $conversaoTaxa = $objConversaoTaxa->buscarPorId( $id );
        if(empty( $conversaoTaxa )  ){
            return redirect()->route($this->entidade.'.index')
                    ->withInput()
                    ->withErrors([
                        'error' => 'Você não tem permissão para acessar esta área.',
                    ]);
        }
        unset( $objConversaoTaxa );
        return view($this->modulo.'.'.$this->entidade.'.editar',compact('conversaoTaxa', 'aba'));
    }
    /**
     * Atualizar a forma de pagamento
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function atualizar(Request $request, $id){
        $objConversaoTaxa =  new ConversaoTaxa();
        $conversaoTaxa = $objConversaoTaxa->buscarPorId( $id );
        if(empty( $conversaoTaxa )  ){
            return redirect()->route($this->entidade.'.index')
                    ->withInput()
                    ->withErrors([
                        'error' => 'Você não tem permissão para acessar esta área.',
                    ]);
        }
        //Tratar campos
        $request->offsetSet('porcentagem', str_replace('%', '',$request->porcentagem));
        $request->offsetSet('porcentagem', str_replace(',', '',$request->porcentagem));
        $request->request->add(['porcentagem' => floatval($request->porcentagem)]);
        
        $request->offsetSet('valor_minimo', str_replace('$', '',$request->valor_minimo));
        $request->offsetSet('valor_minimo', str_replace(',', '',$request->valor_minimo));
        $request->request->add(['valor_minimo' => floatval($request->valor_minimo)]);
        
        $request->offsetSet('valor_maximo', str_replace('$', '',$request->valor_maximo));
        $request->offsetSet('valor_maximo', str_replace(',', '',$request->valor_maximo));
        $request->request->add(['valor_maximo' => floatval($request->valor_maximo)]);
        $request->validate([
            'valor_minimo' => ['required'],
            'valor_maximo' => ['required'],
            'porcentagem' => ['required']
        ]);        
        $conversaoTaxa->atualizar($request->all());
        unset($objConversaoTaxa);
        return redirect()->route($this->entidade.'.index', [$conversaoTaxa->id,2])
                        ->with('success','Taxa de Conversão atualizada com sucesso!');
    }
}
