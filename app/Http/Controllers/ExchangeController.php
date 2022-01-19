<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ExchangeRepository;

class ExchangeController extends Controller
{
    
    /**
     * @var private $exchangeRepository 
     */

    private $exchangeRepository;

    /**
     * Método Construtor
     */

     public function __construct()
     {
         $this->exchangeRepository = new ExchangeRepository();
     }

     /**
      * Método responsável por invocar a cotação
      * @param Request $request
      *
      * @return Response $reponse
      */

      public function exchange(Request $request)
      {
          $data = $request->all();
          $exchange = $this->exchangeRepository->makeExchange($data);
          return response()->json($exchange, $exchange['httpCode']);
      }
}
