<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\ConversaoHistoricoService;

class ConversaoHistoricoController extends Controller
{
    protected $service;
    
     public function __construct(ConversaoHistoricoService $objConversaoHistoricoService){
 
        $this->service = $objConversaoHistoricoService;

     }
    
    public function index(){
       
        return $this->service->index();
 
     }
 
     public function create(Request $request){
      
         return $this->service->updateOrCreate($request->all());
 
     }
 
 
     public function show(Int $id){
         
         return $this->service->show($id);
 
     }

     public function buscaPorUsuario(Request $request){

        return $this->service->buscaPorUsuario($request->all());
     }
 
}
