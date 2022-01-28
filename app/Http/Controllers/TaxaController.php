<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\TaxaService;
use App\Http\Requests\TaxaRequest;

class TaxaController extends Controller
{
    protected $service;

    public function __construct(TaxaService $objTaxaService,TaxaRequest $request){

        $this->service = $objTaxaService;

    }

    public function index(){
       
        return $this->service->index();
 
     }
 
     public function create(){
      
         return $this->service->updateOrCreate($request->all());
 
     }
 
     public function update(Request $request, Int $id){
         
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
