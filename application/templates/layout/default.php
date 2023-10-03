<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */
$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
    <head>
        <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            <?= $cakeDescription ?>:
            <?= $this->fetch('title') ?>
        </title>
        <?= $this->Html->meta('icon') ?>

        <?= $this->Html->css(['normalize.min', 'milligram.min', 'jquery.modal.min', 'fonts', 'cake', 'fontawesome', 'solid']) ?>
        <?= $this->Html->script(['jquery-3.7.1.min', 'jquery.modal.min']) ?>

        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>
    </head>
    <body>
        <nav class="top-nav">
            <div class="top-nav-title">
                <a href="<?= $this->Url->build('/') ?>"><span>desafio</span>DEV</a> 
            </div>
            <div>
                <?php
                if ($this->Identity->isLoggedIn()) {
                    ?>
                    <div class="top-nav-links"> 
                        <?= $this->Html->link("Home", ['controller' => 'Pages', 'action' => 'home']) ?> | 
                        <?= $this->Html->link("Usuários", ['controller' => 'Users', 'action' => 'index']) ?> | 
                        <?= $this->Html->link("Métodos de Pagamentos", ['controller' => 'PaymentMethods', 'action' => 'index']) ?> |
                        <?= $this->Html->link("Histórico de Conversão", ['controller' => 'CurrencyConversions', 'action' => 'index']) ?> |
                        <?= $this->Identity->get('email') ?> | <?= $this->Html->link("Logout", ['controller' => 'Users', 'action' => 'logout']) ?>
                        <?php
                    } else {
                        ?>
                        <?= $this->Html->link("Login", ['controller' => 'Users', 'action' => 'login'], ['class' => 'button']) ?>
                        <?php
                    }
                    ?>
                </div>
        </nav>
        <main class="main">
            <div class="container">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
        </main>
        <footer>
        </footer>
        <div id="loader">
            <div id="spinner"></div>
        </div>
    </body>
</html>
