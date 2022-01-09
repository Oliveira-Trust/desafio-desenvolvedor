<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ConversaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Conversaos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conversao-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Conversao'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'moedaorigem',
            'valororigem',
            'moedadestino',
            'cotacaoatual',
            //'formadepagamento',
            //'taxapagamento',
            //'taxaconversao',
            //'valorconversao',
            //'datacriacao',
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {delete}',
            ],
        ],
    ]); ?>


</div>
