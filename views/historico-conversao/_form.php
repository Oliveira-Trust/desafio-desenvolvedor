<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HistoricoConversao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="historico-conversao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'moedaorigem')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'valororigem')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'moedadestino')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'valordestino')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'formadepagamento')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cotacao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'taxapagamento')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'taxaconversao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'valorfinal')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
