<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ConversaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Histórico de Conversões');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conversao-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Converter'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'moedaorigem',
                'label' => 'De'
            ],
            [
                'attribute'=>'valororigem',
                'label' => 'Valor BRL'
            ],
            [
                'attribute'=>'moedadestino',
                'label' => 'Para'
            ],
            [
                'attribute'=>'cotacaoatual',
                'label' => 'Cotação BRL'
            ],
            'formadepagamento',
            [
                'attribute'=>'taxapagamento',
                'label' => 'Taxa de Pag.'
            ],
            [
                'attribute'=>'taxaconversao',
                'label' => 'Taxa de Conv.'
            ],
            [
                'attribute'=>'valorconversao',
                'label' => 'Valor convertido'
            ],
            [
                'attribute'=>'datacriacao',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDateTime(strtotime($model->datacriacao), 'php: H:i:s d/m/Y');
                },
            ],
            [
//                'class' => ActionColumn::className(),
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete}',
            ],
        ],
    ]); ?>


</div>
