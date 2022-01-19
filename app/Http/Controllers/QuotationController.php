<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\QuotationsRepository;

class QuotationController extends Controller
{
    
    /**
     * @var private quotationsRepository
     */

     private $quotationRepository;

     /**
      * Método construtor
      */

      public function __construct()
      {
          $this->quotationRepository = new QuotationsRepository();
      }

      /**
       * Método responsável por invocar a coleta de todas as cotações de um usuário
       * 
       * @return Response $quotations
       */

       public function getall()
       {
           $quotations = $this->quotationRepository->getAll();
           return response()->json($quotations,$quotations['httpCode']);
        }

       /**
       * Método responsável por invocar a coleta de uma cotação especifica de um usuário
       * 
       * @param Resquest $request
       * 
       * @return Response $quotations
       */

      public function getById(Request $request)
      {
          $quotation = $this->quotationsRepository->getById($request->id);
          return response()->json($quotation,$quotation['httpCode']);
      }


}
