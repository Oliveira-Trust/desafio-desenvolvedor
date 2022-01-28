<?php

namespace App\Http\Services;

use App\Http\Repositories\TaxaRepository;

class TaxaService
{
    protected $repository;

    public function __construct(TaxaRepository $objTaxaRepository){

        $this->repository = $objTaxaRepository;

    }
   
    public function index(){
        
        return $this->repository->getAll();
    }
    
    public function show($id){

        return $this->repository->show($id);

    }
    
    public function showAll($id){

        return $this->repository->showAll($id);

    }

    public function updateOrCreate($request, Int $id = null){
        if(!empty($id)){
            $request['id'] = $id;  
        }
       
        return $this->repository->updateOrCreate($request);

    }

    public function delete($id){

        return $this->repository->delete($id);

    }

    public function destroy($id){

        return $this->repository->destroy($id);

    }

    
}
