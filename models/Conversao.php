<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * Esta é a classe modelo para a tabela "conversao".
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
     * Regras de validação dos atributos do model
     */
    public function rules()
    {
        return [
            [['valororigem'], 'number', 'min' => 1000, 'message'=>'{attribute} não pode ser inferior a 1000.' ],
            [['valororigem'], 'number', 'max' => 100000, 'message'=>'{attribute} não pode ser superior a 100.000.' ],
            [['moedaorigem', 'valororigem', 'moedadestino', 'cotacaoatual', 'formadepagamento', 'valorconversao'], 'required'],
            [['valororigem', 'cotacaoatual', 'taxapagamento', 'taxaconversao', 'valorconversao', 'valortaxa'], 'number'],
            [['datacriacao','valortaxa'], 'safe'],
            [['moedaorigem', 'moedadestino', 'formadepagamento'], 'string', 'max' => 30],
        ];
    }

    /**
     * Labels dos atributos do model
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
            'valortaxa' => Yii::t('app', 'Valor da taxa'),
            'datacriacao' => Yii::t('app', 'Data da conversão'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return ConversaoQuery Active query usada pela classe Active Record.
     */
    public static function find()
    {
        return new ConversaoQuery(get_called_class());
    }
    
    /**
     * Retorna as moedas para a conversão consultando a API
     * 
     * @return array | yii\helpers\ArrayHelper;
     */
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
    
    /**
     * Retorna a cotação da moeda consultando a API
     * 
     * @param string $moeda abreviação da moeda (code)
     * 
     * @return array | yii\helpers\ArrayHelper;
     */
    public static function getCotacaoMoeda($moeda) 
    {
        $jsonApi = file_get_contents('https://economia.awesomeapi.com.br/last/'.$moeda.'-BRL');
        
        $arrMoedas = json_decode($jsonApi, true);
        
        foreach ($arrMoedas as $key => $value) {
            $info = ['id'=>$key, 'info'=>$value];
        };
        
        return $info['info']['bid'];
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
     * Preenche os atributos taxapagamento e taxaconversao com seus rescpectivos
     * calculos antes do model ser salvo no banco de dados.
     * 
     * @return float 
     */
    public function beforeSave($insert) {

        $this->taxapagamento = $this->calcularTaxaPagamento();
        $this->taxaconversao = $this->calcularTaxaConversao();

        return parent::beforeSave($insert);
    }
}
