<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "produto".
 *
 * @property int $id
 * @property string|null $nome
 * @property float|null $preco
 *
 * @property PedidoProduto[] $pedidoProdutos
 */
class Produto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'produto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['preco'], 'number'],
            [['nome'], 'string', 'max' => 100],
            [['nome', 'preco'], 'required']
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
            'preco' => 'Preco',
        ];
    }

    /**
     * Gets query for [[PedidoProdutos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPedidoProdutos()
    {
        return $this->hasMany(PedidoProduto::className(), ['id_produto' => 'id']);
    }

    /**
     * Gets query for [[PedidoProdutos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProdutosByPedido($id_pedido)
    {
        return $this->hasMany(PedidoProduto::className(), ['id_pedido' => $id_pedido]);
    }    

    /**
     * Get all the available produtos
     * @return array available produtos
     */
    public static function getAvailableProdutos()
    {
        $produtos = self::find()->asArray()->all();
        $items = ArrayHelper::map($produtos, 'id', 'nome');
        return $items;
    }
}
