<?php 

    include_once(__DIR__ . '/../utils/functions.php');

    siteHeader();

?>

<div class="container h-100">
        <div class="row h-100">
            <div class="col-md-3"></div>
            <div class="col-md-6 my-auto">
                <form id="formCadastroUser">
                    <h1 class="h3 mb-3 font-weight-normal">Cadastro</h1>
                    <label for="name" class="sr-only">Nome</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Seu nome" required >
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Seu endereço de email" required>
                    <label for="password" class="sr-only">Senha</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Sua senha" required>
                    <button class="btn btn-lg btn-primary btn-block mt-3" type="button" onclick="new Cadastro().cadastrarUsuario()">Fazer login</button>
                    <div class="text-center">
                        Já possui cadastro? <a href="login.php">Faça login</a>
                    </div>
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
</div>


<?php

    siteFooter();

?>