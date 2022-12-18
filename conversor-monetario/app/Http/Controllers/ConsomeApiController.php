<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DadosFormController;
use App\Http\Requests\StoreConversao;
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

        return view('/conversor/home', ['traducaoMoeda' => $traducaoMoeda]); 
    }

    public function storeConversao(StoreConversao $request){
        $cotacao = $this->conversaoApiService->getCotacao($request->base, $request->destino);
        $valorFinal = $this->calculaService->calculaTaxa($cotacao, $request->valor, $request->pagamento);

        //dd($valorFinal);

    }
}
