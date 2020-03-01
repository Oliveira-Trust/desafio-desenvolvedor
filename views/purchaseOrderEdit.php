<?php 

    include_once(__DIR__ . '/../utils/functions.php');

    siteHeader();

    navBar();

    $id = (!isset($_GET['id'])) ? 0 : $_GET['id'];

?>

    <div class="container">
        <form id="formPurchaseOrderGetData">
            <h1 class="h3 mb-3 mt-3 font-weight-normal">Editar Pedido de Compra</h1>
            <div class="form-group">
                <label for="cliente">Cliente:</label>
                <select class="form-control" name="clientId" id="clientId">
                    <option>Selecione</option>
                </select>
            </div>
            <div class="form-group">
                <label for="produto">Produto:</label>
                <select class="form-control" name="productId" id="productId">
                    <option>Selecione</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" name="status" id="status">
                    <option>Selecione</option>
                    <option>Em aberto</option>
                    <option>Pago</option>
                    <option>Cancelado</option>
                </select>
            </div>
            <div class="form-group">
                <label for="qtd">Quantidade:</label>
                <input type="number" id="qtd" name="qtd" class="form-control" min="1" />
            </div>
            <button type="button" class="btn btn-primary" onclick="new PurchaseOrder().updateOrder(<?=$id?>)">Editar</button>
        </form>
    </div>

    <script>
        new PurchaseOrder().getDataEdit(<?=$id?>);
    </script>

<?php

    siteFooter();

?>