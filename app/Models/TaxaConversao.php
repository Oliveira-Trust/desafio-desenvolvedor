<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxaConversao extends Model
{
    protected $fillable = [
        'valor_referencia', 'taxa_maior', 'taxa_menor'
    ];

    // Calcular a taxa de conversão, recebendo do valor para a conversão
    // Retorno será a variável $valorAcrescido que receberá o valor da conversão aplicada a taxa
    public function calcularTaxaConversao($valorConversao){       
  
       if ($valorConversao > $this->valor_referencia){
            $taxa = $this->taxa_menor;
       }else{
            $taxa = $this-> taxa_maior;
       }        
      
       $valorAcrescido = $valorConversao + ($valorConversao / 100 * $taxa);   
  
       return $valorAcrescido;
    }

    // Atribuir a variável $taxa o valor da taxa a ser aplicada de acordo com o valor de referência
    // Retorno será a variável $taxa
    public function valorTaxaConversao($valorConversao){
        if ($valorConversao > $this->valor_referencia){
            $taxa = $this->taxa_menor;
       }else{
            $taxa = $this-> taxa_maior;
       }        
      
        return $taxa;  
    }
}
