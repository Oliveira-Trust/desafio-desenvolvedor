<?php

namespace App\Http\Repositories;

use App\Models\Taxa;

class TaxaRepository
{
    protected $model;

    public function __construct(Taxa $model){
        $this->model = $model;
    }

    public function getAll(){
        
        return $this->model->with('tipopagamentos')->get();

    }

    public function show($id){

        $this->model = $this->model->find($id);
        $this->model->arTipoPagamentos = $this->model->find($id)->tipopagamentos()->first(); 
   
        return $this->model;

    }

    public function updateOrCreate($data){
      
        if(!empty($data['id'])){
            $this->model = $this->model->firstOrNew(['id' => $data['id']]);
            
        }

        $this->model->fill($data);
        $this->model->save();

        return $this->model;

    }

    public function delete($id){

        return $this->model->delete($id);

    }

    public function buscaTaxaPersonalizada(Int $idTipoPagamento,Float $flValorTaxa){
        try {
            if($idTipoPagamento!==0){
                return $this->model->firstOrNew(['idTipoPagamento' => $idTipoPagamento]);
             }
         
             return $this->model->whereNull('idTipoPagamento')
                            ->whereRaw("{$flValorTaxa} > flValorMinTaxa AND {$flValorTaxa} < flValorMaxTaxa")
                            ->firstOrFail()->getAttributes()['flTaxa'];
                 
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
       
    }
    
}
