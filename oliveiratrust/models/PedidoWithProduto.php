<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pedido;
use yii\helpers\ArrayHelper;

class PedidoWithProduto extends Pedido
{
    /**
     * @var array IDs of the produtos
     */
    public $ids_produto = [];
    
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            // each id_produto must exist in produto table
            ['ids_produto', 'each', 'rule' => [
                    'exist', 'targetClass' => Produto::className(), 'targetAttribute' => 'id'
                ]
            ],
        ]);
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'ids_produto' => 'Produtos',
        ]);
    }

    /**
     * load the pedido's produtos
     */
    public function loadProdutos()
    {
        $this->ids_produto = [];
        if (!empty($this->id)) {
            $rows = PedidoProduto::find()
                ->select(['id_produto'])
                ->where(['id_pedido' => $this->id])
                ->asArray()
                ->all();
            foreach($rows as $row) {
               $this->ids_produto[] = $row['id_produto'];
            }
        }
    }

    /**
     * save the pedido's produtos
     */
    public function saveProdutos()
    {
        /* clear the produtos of the pedido before saving */
        PedidoProduto::deleteAll(['id_pedido' => $this->id]);
        if (is_array($this->ids_produto)) {
            foreach($this->ids_produto as $id_produto) {
                $pp = new PedidoProduto();
                $pp->id_pedido = $this->id;
                $pp->id_produto = $id_produto;
                $pp->save();
            }
        }
    }
}
