<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\ConversaoForm */
/* @var $form ActiveForm */
?>
<div class="conversao-index">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'moedaorigem')->textInput(['readonly' => true]) ?>
        <?= $form->field($model, 'valororigem') ?>
        <?= $form->field($model, 'moedacompra')->dropDownList(
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
        <?= $form->field($model, 'cotacaoatual')->textInput(['readonly' => true]) ?>
        <?= $form->field($model, 'formapagamento')->dropDownList(
                $listaFormaPagamento,
                [
                    'prompt'=>'Selecione a forma de pagamento',
                    'onchange'=>'
                        $.get( "'.Url::toRoute('/conversao/valor-convertido').'", 
                            { 
                                formapagamento: $(this).val(), 
                                cotacaoatual: $("#conversaoform-cotacaoatual").val(),
                                valororigem: $("#conversaoform-valororigem").val()
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
        <?= $form->field($model, 'valortaxa')->textInput(['readonly' => true]) ?>
        <?= $form->field($model, 'valorconversao')->textInput(['readonly' => true]) ?>

    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Converter'), ['id'=>'converter', 'class' => 'btn btn-primary', 'disabled'=>'disabled']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- conversao-index -->
