<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\MoedaService;

class MoedaController extends Controller
{
    protected $service;

    public function __construct(MoedaService $objMoedaService){

        $this->service = $objMoedaService;

    }

    public function index(){
       
        return $this->service->index();
 
     }
 
     public function create(){
      
         return $this->service->updateOrCreate($request->all());
 
     }
 
     public function update(Int $id){
         
         return $this->service->updateOrCreate($request->all(), $id);
 
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
