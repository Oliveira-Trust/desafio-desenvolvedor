<?php 

    include_once(__DIR__ . '/../utils/functions.php');

    siteHeader();

    navBar();

?>

    <div class="container">
        <form id="formClientGetData">

            <h1 class="h3 mb-3 mt-3 font-weight-normal">Clientes</h1>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="fieldOrder">Ordenar por</label>
                    <select class="form-control" name="fieldOrder" id="fieldOrder">
                        <option>Selecione</option>
                        <option value="name">Nome</option>
                        <option value="email">Email</option>
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
                        <option value="name">Nome</option>
                        <option value="email">Email</option>
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
                            <th scope="col">Nome</th>
                            <th scope="col">Email</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="clientData"></tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-sm-6 mt-2 text-left">
                    <button type="button" class="btn btn-success" id="refreshList" onclick="new Client().getData()">Atualizar lista</button>
                </div>
                <div class="col-sm-6 mt-2 text-right">
                    <button type="button" class="btn btn-danger" id="deleteSelected" onclick="new Client().deleteSelected()">Deletar selecionados</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        new Client().getData();
    </script>

<?php

    siteFooter();

?>