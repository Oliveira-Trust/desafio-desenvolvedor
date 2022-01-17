<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversao extends Model
{
    use HasFactory;
    
    protected $table = 'conversaos';
    
    protected $fillable = [
        'moedaorigem', 
        'valororigem', 
        'moedadestino', 
        'cotacaoatual', 
        'formadepagamento', 
        'taxadepagamento', 
        'taxadeconversao', 
        'valorconversao'
        ];
    
    protected $attributes = [
        'moedaorigem' => 'BRL'
    ];
    
    const FORMA_PAGAMENTO_BOLETO = 'Boleto';
    const FORMA_PAGAMENTO_CARTAO = 'Cartão';
    
    const TAXA_BOLETO = 1.45;
    const TAXA_CARTAO = 7.63;
    
    const TAXA_ABAIXO_TRES = 2;
    const TAXA_ACIMA_TRES = 1;
    
    /**
     * Retorna as moedas para a conversão consultando a API
     * 
     * @return array 
     */
    public function getMoedas() 
    {
        $jsonApi = file_get_contents('https://economia.awesomeapi.com.br/last/USD-BRL,EUR-BRL,BTC-BRL,ETH-BRL');
        
        $arrMoedas = json_decode($jsonApi, true);
        
        foreach ($arrMoedas as $key => $value) {
            $items[$value['code']] = ['id'=>$value['code'], 'descricao'=>$value['code'].' - '.$value['name']];
        };
        
        return $items;
    }
    
    /**
     * Retorna a cotação da moeda consultando a API
     * 
     * @param string $moeda abreviação da moeda (code)
     * 
     * @return float 
     */
    public function getCotacaoMoeda($moeda) 
    {
        if(isset($moeda) && is_string($moeda) && (strlen($moeda) == 3)){
            $jsonApi = file_get_contents('https://economia.awesomeapi.com.br/last/'.$moeda.'-BRL');

            $arrMoedas = json_decode($jsonApi, true);

            foreach ($arrMoedas as $key => $value) {
                $info = ['id'=>$key, 'info'=>$value];
            };
        }
        
        return (float)$info['info']['bid'];
    }
    
    /**
     * Retorna um array com as formas de pagamento
     * 
     * @return array 
     */
    public function getFormaPagamento() 
    {
        $items = [
            self::FORMA_PAGAMENTO_BOLETO => self::FORMA_PAGAMENTO_BOLETO,
            self::FORMA_PAGAMENTO_CARTAO => self::FORMA_PAGAMENTO_CARTAO
        ];
        
        return $items;
}
    
    /**
     * Calcula a taxa de pagamento no Cartão ou Boleto
     * 
     * @return float 
     */
    public function calcularTaxaPagamento() 
    {
        if($this->formadepagamento == self::FORMA_PAGAMENTO_BOLETO){
            $taxa = ($this->valororigem * (self::TAXA_BOLETO / 100));
        } else if ($this->formadepagamento == self::FORMA_PAGAMENTO_CARTAO){
            $taxa = ($this->valororigem * (self::TAXA_CARTAO / 100));
        }
        
        return (float)$taxa;
    }
    
    /**
     * Calcula a taxa de conversão que pode ser 2% se o valor for menor que 3000
     * ou que pode ser 1% se o valor for maior que 3000
     * 
     * @return float 
     */
    public function calcularTaxaConversao() 
    {
        if($this->valororigem < 3000){
            $taxa = ($this->valororigem * (self::TAXA_ABAIXO_TRES / 100));
        } else if ($this->valororigem > 3000){
            $taxa = ($this->valororigem * (self::TAXA_ACIMA_TRES / 100));
        }
        
        return (float)$taxa;
    }
    
    /**
     * Calcula o valor Total que foi convertido
     * 
     * @return float 
     */
    public function calcularValorConvertido() 
    {
        $taxaPagamento = $this->calcularTaxaPagamento();
        $taxaConversao = $this->calcularTaxaConversao();
        
        $valorDescontado = ($this->valororigem - $taxaPagamento - $taxaConversao);
        
        $total = ((float)$valorDescontado / (float)$this->cotacaoatual);
        
        return (float)$total;
    }
    
}
