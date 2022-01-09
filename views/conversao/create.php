<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Conversao */

$this->title = Yii::t('app', 'Create Conversao');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Conversaos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conversao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'listaMoedas' => $listaMoedas,
        'listaFormaPagamento' => $listaFormaPagamento
    ]) ?>

</div>
