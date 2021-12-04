<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Exception;


class Taxas extends Controller
{  
    public $percentual;

    protected const VALOR_MIN_COMPRA = 1000;

    protected const VALOR_MAX_COMPRA = 100.000; 

    protected const VALOR_CONVERSAO = 3000;


    public function stopRunning($currentBalance) 
    {
        if ($currentBalance <= self::VALOR_MIN_COMPRA ) {
            throw new Exception('O valor da compra deve ser superior a 1.000,00 BRL ');
        }
         
        if ($currentBalance < self::VALOR_MAX_COMPRA ) {
            throw new Exception('O valor da compra deve ser menor que 100.000,00 BRL ');
        } 
    }

    /**
     * retorna a taxa de acordo com o tipo de pagamento
     * @param string
     *
     * @return $taxa
     */
    public function payment($type) 
    {  
        if ($type === 'boleto') {
            return 1.45;
        }

        if ($type === 'cartao_credito') {
            return 7.63;   
        }
    }

    /**
     * retorna a taxa de acordo com o tipo de pagamento
     * @param string
     *
     * @return $percentual
     */
    public function percentageFeeWithOneOrTwo($totalBalance) 
    {
       if ($totalBalance < self::VALOR_CONVERSAO ) {
           $this->percentual = 2;

           return  $this->percentual;
       }

       if ($totalBalance > self::VALOR_CONVERSAO ) {
           $this->percentual = 1;

           return  $this->percentual;
       }
    }
}
