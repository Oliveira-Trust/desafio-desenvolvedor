<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "historico_conversao".
 *
 * @property int $id
 * @property string|null $moedaorigem
 * @property float|null $valororigem
 * @property string|null $moedadestino
 * @property float|null $valordestino
 * @property string|null $formadepagamento
 * @property float|null $cotacao
 * @property float|null $taxapagamento
 * @property float|null $taxaconversao
 * @property float|null $valorfinal
 * @property string $datacriacao
 */
class HistoricoConversao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'historico_conversao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['valororigem', 'valordestino', 'cotacao', 'taxapagamento', 'taxaconversao', 'valorfinal'], 'number'],
            [['datacriacao'], 'safe'],
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
            'moedaorigem' => Yii::t('app', 'Moedaorigem'),
            'valororigem' => Yii::t('app', 'Valororigem'),
            'moedadestino' => Yii::t('app', 'Moedadestino'),
            'valordestino' => Yii::t('app', 'Valordestino'),
            'formadepagamento' => Yii::t('app', 'Formadepagamento'),
            'cotacao' => Yii::t('app', 'Cotacao'),
            'taxapagamento' => Yii::t('app', 'Taxapagamento'),
            'taxaconversao' => Yii::t('app', 'Taxaconversao'),
            'valorfinal' => Yii::t('app', 'Valorfinal'),
            'datacriacao' => Yii::t('app', 'Datacriacao'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return HistoricoConversaoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new HistoricoConversaoQuery(get_called_class());
    }
}
