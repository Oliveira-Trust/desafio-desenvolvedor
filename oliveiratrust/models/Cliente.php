<?php

namespace app\models;

use Yii;
use yiibr\brvalidator\CpfValidator;

/**
 * This is the model class for table "cliente".
 *
 * @property int $id
 * @property string|null $nome
 * @property string|null $sobrenome
 * @property string|null $cpf
 *
 * @property Pedido[] $pedidos
 */
class Cliente extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cliente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'sobrenome', 'cpf'], 'required'],
            [['nome', 'sobrenome'], 'string', 'max' => 100],
            [['cpf'], 'string', 'max' => 14],
            ['cpf', CpfValidator::className()],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'sobrenome' => 'Sobrenome',
            'cpf' => 'Cpf',
        ];
    }

    /**
     * Gets query for [[Pedidos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedido::className(), ['id_cliente' => 'id']);
    }
}
