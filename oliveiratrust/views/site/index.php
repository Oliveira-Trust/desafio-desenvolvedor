<?php

use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Desafio Oliveira Trust';
?>



<div class="site-index">

    <div class="jumbotron">
    
    <h2>DESAFIO PARA CANDIDATOS A VAGA DE DESENVOLVEDOR PHP</h2>
    
   </div>

    <div class="body-content">
        <?php if (!Yii::$app->user->isGuest) {?>
        <div class="row">
            <div class="col-lg-4">
            <p><a class="btn btn-lg btn-success" href="<?php echo Url::toRoute(['cliente/index'])?>">Clientes</a></p></div>
            <div class="col-lg-4">
            <p><a class="btn btn-lg btn-success" href="<?php echo Url::toRoute(['produto/index'])?>">Produtos</a></p></div>
            <div class="col-lg-4">  
            <p><a class="btn btn-lg btn-success" href="<?php echo Url::toRoute(['pedidos/index'])?>">Pedidos</a></p></div>
        </div>
        <?php }?>
    </div>
</div>
