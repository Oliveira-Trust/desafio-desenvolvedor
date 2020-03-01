<?php 

    include_once(__DIR__ . '/../utils/functions.php');

    siteHeader();

    navBar();

?>

    <div class="container">
        <form id="formPurchaseOrderGetData">

            <h1 class="h3 mb-3 mt-3 font-weight-normal">Pedidos de compra</h1>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="fieldOrder">Ordenar por</label>
                    <select class="form-control" name="fieldOrder" id="fieldOrder">
                        <option>Selecione</option>
                        <option value="clientName">Cliente</option>
                        <option value="productName">Produto</option>
                        <option value="status">Status</option>
                        <option value="qtd">Quantidade</option>
                        <option value="price">Preço Unitário</option>
                        <option value="totalPrice">Preço Total</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="orderType">De forma</label>
                    <select class="form-control" name="orderType" id="orderType">
                        <option>Selecione</option>
                        <option value="ASC">Crescente</option>
                        <option value="DESC">Decrescente</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="fieldFilter">Filtrar por</label>
                    <select class="form-control" name="fieldFilter" id="fieldFilter">
                        <option>Selecione</option>
                        <option value="c.name">Cliente</option>
                        <option value="p.name">Produto</option>
                        <option value="status">Status</option>
                        <option value="qtd">Quantidade</option>
                        <option value="price">Preço Unitário</option>
                        <option value="totalPrice">Preço Total</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="fieldValue">Valor</label>
                    <input type="text" placeholder="Digite o valor do campo" class="form-control" name="fieldValue" id="fieldValue" />
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Produto</th>
                            <th scope="col">Status</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Preço Unitário</th>
                            <th scope="col">Preço Total</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="purchaseOrderData"></tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-sm-6 mt-2 text-left">
                    <button type="button" class="btn btn-success" id="refreshList" onclick="new PurchaseOrder().getData()">Atualizar lista</button>
                </div>
                <div class="col-sm-6 mt-2 text-right">
                    <button type="button" class="btn btn-danger" id="deleteSelected" onclick="new PurchaseOrder().deleteSelected()">Deletar selecionados</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        new PurchaseOrder().getData();
    </script>

<?php

    siteFooter();

?>