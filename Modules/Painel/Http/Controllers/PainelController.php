<?php

namespace Modules\Painel\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ConversorMoedas\Entities\Taxas;
use Modules\ConversorMoedas\Entities\LogConversoes;

class PainelController extends Controller
{
    
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('painel::index');
    }

    /**
     * Conversor Moedas 
     * @return Nill
     */
    public function conversor()
    {
        $taxas = Taxas::where('ativo', '=', 1)->orderBy('tipo', 'ASC')->get();
        return view('painel::conversor.form',['taxas'=>$taxas]);
    }
    
    /**
     * Buscar Api Conversor Moedas
     * @return Renderable
     */
    public function conversoesLista(){
        $logs = LogConversoes::where('user_id', '=', auth()->user()->id)->paginate(20);
        return view('painel::conversor.listagem',['itens'=>$logs]);
    }
    
    /**
     * Buscar Formas Pagamento - Conversor Moedas
     * @return Array
     */
    public function formasPagamento(){
        $taxas = Taxas::where('ativo', '=', 1)->paginate(5);
        return view('painel::conversor.formas-pagamento',['taxas'=>$taxas]);
    }
    
    /**
     * Criar uma nova Taxa
     * @param Request $request
     * @return Boolean
     */
    public function create(Request $request)
    {
        $request->validate([
            'tipo' => 'required|string',
            'valor' => 'required',
        ]);
        
        $data = [
            'tipo' => $request->tipo,
            'valor' =>$request->valor,
            'ativo' =>true,
        ];
        
        $resultado = Taxas::create($data);
        if($resultado)
            return $resultado;
        else    
            return false;
    }
    
    /**
     * Show the form for editing the specified resource.
     * @param $request
     * @return Boolean
     */
    public function edit(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'valor' => 'required|string',
        ]);

        $taxas = Taxas::find($request->id);
        $taxas->valor = $request->valor;
        $resultado = $taxas->save(); 
        return $resultado;
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Boolean
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);

        $taxas = Taxas::find($request->id);
        $taxas->ativo = false;
        $resultado = $taxas->save(); 
        return $resultado;
    }
}
