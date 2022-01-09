<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "conversao".
 *
 * @property int $id
 * @property string $moedaorigem
 * @property float $valororigem
 * @property string $moedadestino
 * @property float $cotacaoatual
 * @property string $formadepagamento
 * @property float $taxapagamento
 * @property float $taxaconversao
 * @property float $valorconversao
 * @property string $datacriacao
 */
class Conversao extends \yii\db\ActiveRecord
{
    const FORMA_PAGAMENTO_BOLETO = 'Boleto';
    const FORMA_PAGAMENTO_CARTAO = 'Cartão';
    
    const TAXA_BOLETO = 1.45;
    const TAXA_CARTAO = 7.63;
    
    const TAXA_ABAIXO_TRES = 2;
    const TAXA_ACIMA_TRES = 1;
    
    public $valortaxa;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'conversao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['moedaorigem', 'valororigem', 'moedadestino', 'cotacaoatual', 'formadepagamento', 'valorconversao'], 'required'],
            [['valororigem', 'cotacaoatual', 'taxapagamento', 'taxaconversao', 'valorconversao', 'valortaxa'], 'number'],
            [['datacriacao','valortaxa'], 'safe'],
            [['moedaorigem', 'moedadestino', 'formadepagamento'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'moedaorigem' => Yii::t('app', 'Moeda de origem'),
            'valororigem' => Yii::t('app', 'Valor de origem'),
            'moedadestino' => Yii::t('app', 'Moeda de destino'),
            'cotacaoatual' => Yii::t('app', 'Cotação atual em BRL'),
            'formadepagamento' => Yii::t('app', 'Forma de pagamento'),
            'taxapagamento' => Yii::t('app', 'Taxa de pagamento em BRL'),
            'taxaconversao' => Yii::t('app', 'Taxa de conversão em BRL'),
            'valorconversao' => Yii::t('app', 'Valor da conversão'),
            'datacriacao' => Yii::t('app', 'Data da conversão'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return ConversaoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ConversaoQuery(get_called_class());
    }
    
    public function getMoedas() 
    {
        $jsonApi = file_get_contents('https://economia.awesomeapi.com.br/last/USD-BRL,EUR-BRL,BTC-BRL,ETH-BRL');
        
        $arrMoedas = json_decode($jsonApi, true);
        
        
        foreach ($arrMoedas as $key => $value) {
            $items[] = ['id'=>$value['code'], 'descricao'=>$value['code'].' - '.$value['name']];
        };
        
        $lista = ArrayHelper::map($items, 'id', 'descricao');
        
        return $lista;
    }
    
    public static function getCotacaoMoeda($moeda) 
    {
        $jsonApi = file_get_contents('https://economia.awesomeapi.com.br/last/'.$moeda.'-BRL');
        
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
        
        if($this->formadepagamento == self::FORMA_PAGAMENTO_BOLETO){
            $taxa = ($this->valororigem * (self::TAXA_BOLETO / 100));
        } else if ($this->formadepagamento == self::FORMA_PAGAMENTO_CARTAO){
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
    
    public function beforeSave($insert) {

        $this->taxapagamento = $this->calcularTaxaPagamento();
        $this->taxaconversao = $this->calcularTaxaConversao();

        
//        print_r($this);
        return parent::beforeSave($insert);
    }
}
