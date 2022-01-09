<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
/**
 * Description of ConversaoForm
 *
 * @author tcarv
 */
class ConversaoForm extends Model 
{
    const FORMA_PAGAMENTO_BOLETO = 'Boleto';
    const FORMA_PAGAMENTO_CARTAO = 'Cartão';
    
    const TAXA_BOLETO = 1.45;
    const TAXA_CARTAO = 7.63;
    
    const TAXA_ABAIXO_TRES = 2;
    const TAXA_ACIMA_TRES = 1;
    
    
    
    public $moedaorigem = 'BRL';
    public $valororigem;
    public $moedacompra;
    public $valortaxa;
    public $valorconversao;
    public $formapagamento;
    public $cotacaoatual;
    

    public function rules()
    {
        return [
            [['moedaorigem', 'valororigem' ,'moedacompra','valorcompra','valorconversao','formapagamento','cotacaoatual'], 'required'],
        ];
    }
    
        /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'moedaorigem' => Yii::t('app', 'Moeda de origem'),
            'valororigem' => Yii::t('app', 'Valor de origem'),
            'moedacompra' => Yii::t('app', 'Moeda de destino'),
            'valortaxa' => Yii::t('app', 'Valor das taxas em BRL'),
            'cotacaoatual' => Yii::t('app', 'Cotação atual em BRL'),
            'formapagamento' => Yii::t('app', 'Forma de pagamento'),
            'valorconversao' => Yii::t('app', 'Valor da conversão'),
        ];
    }
    
    public function getMoedas() 
    {
        $jsonApi = file_get_contents('https://economia.awesomeapi.com.br/last/USD-BRL,EUR-BRL,BTC-BRL,ETH-BRL');
        
        $arrMoedas = json_decode($jsonApi, true);
        
        
        foreach ($arrMoedas as $key => $value) {
            $items[] = ['id'=>$value['code'].'-'.$value['codein'], 'descricao'=>$value['code'].' - '.$value['name']];
        };
        
        $lista = ArrayHelper::map($items, 'id', 'descricao');
        
        return $lista;
    }
    
    public static function getCotacaoMoeda($moeda) 
    {
        $jsonApi = file_get_contents('https://economia.awesomeapi.com.br/last/'.$moeda);
        
        $arrMoedas = json_decode($jsonApi, true);
        
        foreach ($arrMoedas as $key => $value) {
            $info = ['id'=>$key, 'info'=>$value];
        };
        
        return $info['info']['bid'];
    }
    
    public function calcularValorConvertido() 
    {
        $taxaPagamento = $this->calcularTaxaPagamento();
        $taxaConversao = $this->calcularTaxaConversao();
        
        $valorDescontado = ($this->valororigem - $taxaPagamento - $taxaConversao);
        
        $total = ((float)$valorDescontado / (float)$this->cotacaoatual);
        
        return $total;
    }
    
    public function getFormaPagamento() 
    {
        $items = [
            self::FORMA_PAGAMENTO_BOLETO => self::FORMA_PAGAMENTO_BOLETO,
            self::FORMA_PAGAMENTO_CARTAO => self::FORMA_PAGAMENTO_CARTAO
        ];
        
        return $items;
    }
    
    public function calcularTaxaPagamento() 
    {
        
        if($this->formapagamento == self::FORMA_PAGAMENTO_BOLETO){
            $taxa = ($this->valororigem * (self::TAXA_BOLETO / 100));
        } else if ($this->formapagamento == self::FORMA_PAGAMENTO_CARTAO){
            $taxa = ($this->valororigem * (self::TAXA_CARTAO / 100));
        }
        
        return $taxa;
    }
    
    public function calcularTaxaConversao() 
    {
        
        if($this->valororigem < 3000){
            $taxa = ($this->valororigem * (self::TAXA_ABAIXO_TRES / 100));
        } else if ($this->valororigem >= 3000){
            $taxa = ($this->valororigem * (self::TAXA_ACIMA_TRES / 100));
        }
        
        return $taxa;
    }
}
