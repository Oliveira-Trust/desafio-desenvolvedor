<?php
    
namespace  App\Repositories;

use App\Models\Quotation;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class QuotationsRepository {


    /**
     * @var private quotation Model
     */

    private $quotation;

    /**
     * Método construtor
     */

    public function __construct()
    {
        $this->quotation = new Quotation();
    }


    /**
      * Método responsável efetuar a coleta de todas as cotações de um usuário
      * 
      * @return Response $quotations
      */

    public function getAll()
    {
        try {
            $quotations =  $this->quotation->where('user_id', Auth::user()->id)->get();
            $response = array('data'=>$quotations, 'httpCode'=>200);
        }catch(Exception $e) {
            $response = array ('message'=> 'Ocorreu uma falha na coleta das cotações.', 'httpCode'=>400);
            Log::error("Ocorreu uma falha na coleta das cotações do usuário. Error: ". $e->getMessage());
        }
        return $response;
    }

    /**
     * Método responsável por persistir na tabela quotations as cotações do cada usuário
     * 
     * @param array $data
     * 
     * @return void
     */

    public function store($data)
    {
        try {
            $data['user_id'] =  Auth::user()->id;
            $this->quotation->create($data);

        }catch(Exception $e) {
            Log::error("Ocorreu uma falha na persistência da cotação no banco de dados. Error: ". $e->getMessage());
        }
    }

      /**
       * Método responsável por invocar a coleta de uma cotação especifica de um usuário
       * 
       * @param integer $id
       * 
       * @return Response $quotations
       */

 
    public function getById($id)
    {
        try {
            $quotation =  $this->quotation->find($id);
            $response = array('data'=>$quotation, 'httpCode'=>200);

        }catch(Exception $e) {
            $response = array ('message'=> 'Ocorreu uma falha na coleta da cotação. Contate o administrador do sistema', 'httpCode'=>400);
            Log::error("Ocorreu uma falha na coleta de uma cotação especifica.. Error: ". $e->getMessage());
    
        }
    }

}