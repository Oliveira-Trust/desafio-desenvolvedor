<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\HistoricoConversao */

$this->title = Yii::t('app', 'Create Historico Conversao');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Historico Conversaos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="historico-conversao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
