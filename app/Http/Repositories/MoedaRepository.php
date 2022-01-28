<?php

namespace App\Http\Repositories;

use App\Models\Moeda;

class MoedaRepository
{
    protected $model;

    public function __construct(Moeda $model){
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

    public function delete($id){

        return $this->model->delete($id);

    }
    
}
