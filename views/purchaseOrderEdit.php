<?php 

    include_once(__DIR__ . '/../utils/functions.php');

    siteHeader();

    navBar();

?>

    <div class="container">
        <form id="formPurchaseOrderGetData">
            <h1 class="h3 mb-3 mt-3 font-weight-normal">Editar Pedido de Compra</h1>
            <div class="form-group">
                <label for="cliente">Cliente:</label>
                <select class="form-control" id="cliente">
                    <option>Selecione</option>
                </select>
            </div>
            <div class="form-group">
                <label for="produto">Produto:</label>
                <select class="form-control" id="produto">
                    <option>Selecione</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" id="status">
                    <option>Selecione</option>
                </select>
            </div>
            <div class="form-group">
                <label for="qtd">Quantidade:</label>
                <input type="number" id="qtd" name="qtd" class="form-control" min="1" />
            </div>
            <button type="button" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>

    <script>
        //new PurchaseOrder().getDataRegister();
    </script>

<?php

    siteFooter();

?>