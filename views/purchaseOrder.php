<?php 

    include_once(__DIR__ . '/../utils/functions.php');

    siteHeader();

    navBar();

?>

    <div class="container">
        <form id="formPurchaseOrderGetData">
            <h1 class="h3 mb-3 mt-3 font-weight-normal">Pedidos de compra</h1>
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
            <div class="row text-right">
                <div class="col-md-12 mt-2 text-right">
                    <button type="button" class="btn btn-danger text-right" id="deleteSelected">Deletar selecionados</button>
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