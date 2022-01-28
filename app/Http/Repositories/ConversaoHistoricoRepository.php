<?php

namespace App\Http\Repositories;

use App\Models\ConversaoHistorico;

class ConversaoHistoricoRepository
{
    protected $model;

    public function __construct(ConversaoHistorico $model){
        $this->model = $model;
    }

    public function getAll(){
        
        return $this->model->all();

    }

    public function show($id){

        return $this->model->find($id);

    }

    public function updateOrCreate($data){
      
        if(!empty($data['id'])){
            $this->model = $this->model->firstOrNew(['id' => $data['id']]);
            
        }

        $this->model->fill($data);
        $this->model->save();

        return $this->model;

    }

    public function buscaPorUsuario(Int $idUsuario){
        try {
            if($this->model->where('idUsuario',$idUsuario)->get()){
                $data = $this->model->where('idUsuario',$idUsuario)->get();
              
                return json_decode($data,true);
            }
            
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
        
    }

    
}
