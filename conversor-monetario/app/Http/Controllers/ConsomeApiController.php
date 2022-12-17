<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DadosFormController;
use App\Services\ConversaoApiService;
use Illuminate\Support\Facades\Http;

class ConsomeApiController extends Controller
{
    protected $conversaoApiService;

    public function __construct(ConversaoApiService $conversaoApiService){
        $this->conversaoApiService = $conversaoApiService;
    }

    public function pegaLegenda(){
        $traducaoMoeda = $this->conversaoApiService->getLegenda();

        return view('/conversor/home', ['traducaoMoeda' => $traducaoMoeda]); 
    }

    public function pegaDadosCotacao(){
        
    }
}
