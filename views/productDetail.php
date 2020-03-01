<?php 

    include_once(__DIR__ . '/../utils/functions.php');

    siteHeader();

    navBar();

    $id = (!isset($_GET['id'])) ? 0 : $_GET['id'];

?>

    <div class="container">
            <h1 class="h3 mb-3 mt-3 font-weight-normal">Detalhes do Produto</h1>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                    <th scope="row">Nome</th>
                    <td id="name"></td>
                    </tr>
                    <tr>
                    <th scope="row">Preço</th>
                    <td id="price"></td>
                    </tr>
                </tbody>
            </table>
    </div>

    <script>
        new Product().getDataById(<?=$id?>, 'text');
    </script>

<?php

    siteFooter();

?>