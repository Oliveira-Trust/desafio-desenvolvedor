<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\MainService;
use App\Http\Requests\ConversaoRequest;

class MainController extends Controller
{   
    protected $service;

    public function __construct(MainService $objMainService){

        $this->service = $objMainService;

    }
    
    public function realizarConversao(ConversaoRequest $request){
        
        return $this->service->realizarConversao($request->all());
        
    }


}
