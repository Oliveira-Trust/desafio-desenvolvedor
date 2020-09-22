<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PedidoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pedidos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Pedido', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'Cliente',
                'value' => 'cliente.nome'
            ],
            'criacao',
            'status',
            [
	            'attribute' => 'Produtos',
	            'format' => 'html',
	            'value' => function($model) {
		            return Html::a('Produtos', Url::toRoute(['produto/list', 'id_pedido' => $model->id]));
	            }
	        ],            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
