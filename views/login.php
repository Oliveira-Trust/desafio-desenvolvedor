<?php 

    include_once(__DIR__ . '/../utils/functions.php');

    siteHeader();

?>

<div class="container h-100">
        <div class="row h-100">
            <div class="col-md-3"></div>
            <div class="col-md-6 my-auto">
                <h1 class="h3 mb-3 font-weight-normal">Por favor, faça login</h1>
                <label for="email" class="sr-only">Email</label>
                <input type="email" id="email" class="form-control" placeholder="Seu endereço de email" required autofocus>
                <label for="password" class="sr-only">Senha</label>
                <input type="password" id="password" class="form-control" placeholder="Sua senha" required>
                <button class="btn btn-lg btn-primary btn-block mt-3" type="submit">Fazer login</button>
                <div class="text-center">
                    Não possui cadastro? <a href="signup.php">Cadastre-se agora</a>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
</div>


<?php

    siteFooter();

?>