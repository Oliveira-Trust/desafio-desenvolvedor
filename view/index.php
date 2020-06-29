<?php

    session_start();

    if(!isset($_SESSION['acessoPermitido']) || $_SESSION['acessoPermitido'] === false){
        header("Location:../view/login.php");
        return;
    }

    include_once('../utils/UtilitariosHtml.php');

?>

<!DOCTYPE html>
<html>

    <head>

        <script
                src="https://code.jquery.com/jquery-3.5.1.min.js"
                integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
                crossorigin="anonymous"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"> </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
                integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
                crossorigin="anonymous"></script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
                integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"
                crossorigin="anonymous"></script>
        <script type="text/javascript" src="../js/Cliente.js"></script>
        <script type="text/javascript" src="../js/Produto.js"></script>
        <script type="text/javascript" src="../js/ajax.js"></script>
        <script type="text/javascript" src="../js/Gerais.js"></script>
        <script type="text/javascript" src="../js/login.js"></script>
        <script type="text/javascript" src="../js/Pedido.js"></script>




        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
              crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
        <link href="../css/simple-sidebar.css" rel="stylesheet">



    </head>

    <body onload="new Cliente().init();">

    <div class="d-flex" id="wrapper">


        <div class="bg-light border-right" id="sidebar-wrapper">
            <div class="sidebar-heading">Dashboard </div>
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action bg-light" onclick="new Cliente().listarCliente();">
                    Clientes
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-light" onclick="new Produto().listarProduto();">
                    Produtos
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-light" onclick="new Pedido().listarPedido();">
                    Pedidos
                </a>
            </div>
        </div>


        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <button class="btn btn-primary" id="menu-toggle">Abrir menu</button>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="#" onclick="new login().deslogarCliente();">Desconectar <span class="sr-only">(current)</span></a>
                        </li>

                    </ul>
                </div>
            </nav>

            <div class="container-fluid">
                <button class="btn btn-primary" id="abreModal" style="float:right;"
                        onclick="new Gerais().abreModalInserirGenerico();">
                </button>

                <div id="nomeTabelaAtual" style="margin-top:10px; width: 110px; font-size: 25px;">

                </div>

                <div id="tabelaPrincipal" style="margin-top:150px;">

                </div>

            </div>
        </div>

        <?php
            $modal = new UtilitariosHtml();
            $modal->modalInserirGenerico();
            $modal->modalEditarGenerico();
        ?>

    </div>


    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>

    </body>
</html>




