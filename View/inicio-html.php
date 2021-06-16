<?php if (isset($_SESSION['logado'])): ?> <!-- Verifica se o usuário está logado, caso não esteja, não exibe o navbar-->
<div class="container">
    <div class="card-box">
        <h1><?= $titulo; ?></h1>
    </div>

    <?php if (isset($_SESSION['mensagem'])): ?>
    <div class="alert alert-<?= $_SESSION['tipo_mensagem']; ?>">
        <?= $_SESSION['mensagem']; ?>
    </div>
    <?php endif; ?>

    <?php
    unset($_SESSION['mensagem']);
    unset($_SESSION['tipo_mensagem']);
    endif;
    ?>