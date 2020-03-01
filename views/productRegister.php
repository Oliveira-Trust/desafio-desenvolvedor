<?php 

    include_once(__DIR__ . '/../utils/functions.php');

    siteHeader();

    navBar();

?>

    <div class="container">
        <form id="formProductGetData">
            <h1 class="h3 mb-3 mt-3 font-weight-normal">Cadastro de Produto</h1>
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" class="form-control" />
            </div>
            <div class="form-group">
                <label for="price">Preço:</label>
                <input type="text" id="price" name="price" class="form-control" />
            </div>
            <button type="button" class="btn btn-primary" onclick="new Product().registerProduct()">Cadastrar</button>
        </form>
    </div>

<?php

    siteFooter();

?>