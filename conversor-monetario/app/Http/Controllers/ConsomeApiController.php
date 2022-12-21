<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreConversao;
use App\Models\Conversao;
use App\Services\CalculaService;
use App\Services\ConversaoApiService;
use Illuminate\Support\Facades\Http;

class ConsomeApiController extends Controller
{
    protected $conversaoApiService;
    protected $calculaService;

    public function __construct(ConversaoApiService $conversaoApiService, CalculaService $calculaService){
        $this->conversaoApiService = $conversaoApiService;
        $this->calculaService = $calculaService;
    }

    public function index(){
        $traducaoMoeda = $this->conversaoApiService->getLegenda();
        $conversoes = Conversao::all();

        return view('/conversor/home', [
            'traducaoMoeda' => $traducaoMoeda, 
            'conversoes' => $conversoes
        ]); 
    }

    public function storeConversao(StoreConversao $request){
        
        $cotacao = $this->conversaoApiService->getCotacao($request->base, $request->destino);
        $valores = $this->calculaService->calculaTaxa($cotacao, $request->valor, $request->pagamento);

        $store = new Conversao;

        $store->moedadaOrigem = $request->base;
        $store->moedaDestino = $request->destino;
        $store->valorConversao = number_format($request->valor, 2, '.', '');
        $store->formaPagamento = $request->pagamento;
        $store->valorMoedaDestino = number_format((1 / $cotacao), 2, '.', '');
        $store->valorComprado = number_format($valores[0], 2, '.', '');
        $store->taxaPagamento = number_format($valores[1], 2, '.', '');
        $store->taxaConversao = number_format($valores[2], 2, '.', '');
        $store->valorUtilizado = number_format($valores[3], 2, '.', '');

        $store->save();

        return redirect('/');
    }
}
