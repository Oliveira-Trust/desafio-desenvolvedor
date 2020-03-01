<?php 

    include_once(__DIR__ . '/../utils/functions.php');

    siteHeader();

    navBar();

    $id = (!isset($_GET['id'])) ? 0 : $_GET['id'];

?>

    <div class="container">
        <form id="formProductGetData">
            <h1 class="h3 mb-3 mt-3 font-weight-normal">Editar Produto</h1>
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" class="form-control" />
            </div>
            <div class="form-group">
                <label for="price">Preço:</label>
                <input type="text" id="price" name="price" class="form-control" />
            </div>
            <button type="button" class="btn btn-primary" onclick="new Product().updateProduct(<?=$id?>)">Editar</button>
        </form>
    </div>

    <script>
        new Product().getDataEdit(<?=$id?>);
    </script>

<?php

    siteFooter();

?>