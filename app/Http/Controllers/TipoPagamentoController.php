<?php

namespace App\Http\Controllers;

use App\Http\Services\TipoPagamentoService;

class TipoPagamentoController 
{
    protected $service;

    public function __construct(TipoPagamentoService $objTipoPagamentoService){

        $this->service = $objTipoPagamentoService;

    }

    public function index(){
       
        return $this->service->index();
 
     }
 
     public function create(){
      
         return $this->service->updateOrCreate($this->request);
 
     }
 
     public function update(Int $id){
         
         return $this->service->updateOrCreate($this->request, $id);
 
     }
 
     public function show(Int $id){
         
         return $this->service->show($id);
 
     }
 
     public function delete(Int $id){
         
         return $this->service->delete($id);
 
     }
 
     public function destroy(Int $id){
         
         return $this->service->destroy($id);
 
     }
 
   
}
