<?php 

    include_once(__DIR__ . '/../utils/functions.php');

    siteHeader();

    navBar();

    $id = (!isset($_GET['id'])) ? 0 : $_GET['id'];

?>

    <div class="container">
        <form id="formClientGetData">
            <h1 class="h3 mb-3 mt-3 font-weight-normal">Editar Cliente</h1>
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" class="form-control" />
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" class="form-control" />
            </div>
            <button type="button" class="btn btn-primary" onclick="new Client().updateClient(<?=$id?>)">Editar</button>
        </form>
    </div>

    <script>
        new Client().getDataById(<?=$id?>, 'input');
    </script>

<?php

    siteFooter();

?>