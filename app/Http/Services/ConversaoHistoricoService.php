<?php

namespace App\Http\Services;

use App\Http\Repositories\ConversaoHistoricoRepository;

class ConversaoHistoricoService
{
    protected $repository;

    public function __construct(ConversaoHistoricoRepository $objConversaoHistoricoRepository){

        $this->repository = $objConversaoHistoricoRepository;

    }
   
    public function index(){
        
        return $this->repository->getAll();
    }
    
    public function show($id){

        return $this->repository->show($id);

    }
    

    public function updateOrCreate($request, Int $id = null){
        if(!empty($id)){
            $request['id'] = $id;  
        }
       
        return $this->repository->updateOrCreate($request);

    }
    
    public function buscaPorUsuario($request){
        
        $idUsuario = $request['idUsuario'];

        return $this->repository->buscaPorUsuario($idUsuario);
    }
}
