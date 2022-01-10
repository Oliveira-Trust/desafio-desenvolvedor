<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Conversao */

$this->title = "Exibindo conversão: " . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Histórico de Conversões'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="conversao-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Tem certeza que deseja deletar esse item??'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
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
        ],
    ]) ?>

</div>
