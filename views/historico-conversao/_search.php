<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HistoricoConversaoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="historico-conversao-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'moedaorigem') ?>

    <?= $form->field($model, 'valororigem') ?>

    <?= $form->field($model, 'moedadestino') ?>

    <?= $form->field($model, 'valordestino') ?>

    <?php // echo $form->field($model, 'formadepagamento') ?>

    <?php // echo $form->field($model, 'cotacao') ?>

    <?php // echo $form->field($model, 'taxapagamento') ?>

    <?php // echo $form->field($model, 'taxaconversao') ?>

    <?php // echo $form->field($model, 'valorfinal') ?>

    <?php // echo $form->field($model, 'datacriacao') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
