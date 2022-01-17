<?php

namespace App\Http\Controllers;

use App\Models\Conversao;
use App\Http\Requests\StoreConversaoRequest;
use App\Http\Requests\UpdateConversaoRequest;
use Illuminate\Http\Request;

class ConversaoController extends Controller
{
    private $objConversao;

    public function __construct()
    {
        $this->objConversao = new Conversao();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaConversoes = $this->objConversao->all();
        return view('conversoes.index', compact('listaConversoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $conversao = $this->objConversao;
        
        return view('conversoes.create', compact('conversao'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreConversaoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->objConversao->valororigem = $request->valororigem;
        $this->objConversao->moedadestino = $request->moedadestino;
        $this->objConversao->cotacaoatual = $request->cotacaoatual;
        $this->objConversao->formadepagamento = $request->formadepagamento;
        $this->objConversao->taxadepagamento = $this->objConversao->calcularTaxaPagamento();
        $this->objConversao->taxadeconversao = $this->objConversao->calcularTaxaConversao();
        $this->objConversao->valorconversao = $this->objConversao->calcularValorConvertido();
        $this->objConversao->save();

        if($this->objConversao){
            return redirect('conversoes');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Conversao  $conversao
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('conversoes.view', [
            'conversao' => Conversao::findOrFail($id)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Conversao  $conversao
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $conversao = Conversao::destroy($id);
        return redirect('conversoes');
    }
    
    /**
     * Retorna a cotação da moeda no formato Json para preencher o input via ajax
     *
     * @return JSON
     */
    public function cotacaoAtual($moeda)
    {
        return response()->json($this->objConversao->getCotacaoMoeda($moeda));
    }
    /**
     * Retorna as taxas de pagamento e conversão, também retorna o valor convertido
     * no formato Json para ser lido pelo ajax e preencher os inputs
     *
     * @return Array|JSON
     */
    public function calcular($valorOrigem, $cotacaoatual, $formaPagamento)
    {
        $this->objConversao->valororigem = $valorOrigem;
        $this->objConversao->cotacaoatual = $cotacaoatual;
        $this->objConversao->formadepagamento = $formaPagamento;
        
        return json_encode([
                'taxaPagamento'=>number_format($this->objConversao->calcularTaxaPagamento(), 2, '.', ''), 
                'taxaConversao'=>number_format($this->objConversao->calcularTaxaConversao(), 2, '.', ''),
                'valorConvertido'=>number_format($this->objConversao->calcularValorConvertido(), 2, '.', '')
            ]);
    }

    
}
