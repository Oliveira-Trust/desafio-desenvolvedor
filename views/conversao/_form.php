<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Conversao */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="conversao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'moedaorigem')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'valororigem')->textInput(['maxlength' => true, 'type' => 'number']) ?>

    <?= $form->field($model, 'moedadestino')->dropDownList(
                $listaMoedas,
                [
                    'prompt'=>'Selecione uma moeda',
                    'onchange'=>'
                        $.get( "'.Url::toRoute('/conversao/cotacao-atual').'", { moeda: $(this).val() } )
                            .done(function( data ) {
                                $( "#'.Html::getInputId($model, 'cotacaoatual').'" ).val( data );
                            }
                        );
                    '
                ]
                ) ?>

    <?= $form->field($model, 'cotacaoatual')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'formadepagamento')->dropDownList(
                $listaFormaPagamento,
                [
                    'prompt'=>'Selecione a forma de pagamento',
                    'onchange'=>'
                        $.get( "'.Url::toRoute('/conversao/valor-convertido').'", 
                            { 
                                formadepagamento: $(this).val(), 
                                cotacaoatual: $("#conversao-cotacaoatual").val(),
                                valororigem: $("#conversao-valororigem").val()
                            })
                            .done(function( data ) {
                                var dados = JSON.parse(data);
                                $( "#'.Html::getInputId($model, 'valorconversao').'" ).val( dados.valor );
                                $( "#'.Html::getInputId($model, 'valortaxa').'" ).val( dados.taxas );
                                $( "#converter" ).removeAttr("disabled");
                            }
                        );
                    '
                ]
                ) ?>

    <?= $form->field($model, 'valortaxa')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'valorconversao')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Converter'), ['id'=>'converter', 'class' => 'btn btn-primary', 'disabled'=>'disabled']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
