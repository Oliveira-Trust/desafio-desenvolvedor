<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PedidoWithProduto */

$this->title = 'Create Pedido';
$this->params['breadcrumbs'][] = ['label' => 'Pedidos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
    'id' => 'pedido-form',
    'enableAjaxValidation' => false,
]); ?>

<?= $form->field($model, 'id_cliente')->textInput(['type' => 'number']); ?>

<?= $form->field($model, 'status')->listBox($allStatus); ?>

<?= $form->field($model, 'ids_produto')
    ->checkboxList($produtos)
    ->hint('Escolha os produtos');
?>

<div class="form-group">
    <?= Html::submitButton('Create', [
        'class' => 'btn btn-primary'
    ]) ?>
</div>

<?php ActiveForm::end(); ?>

</div>
