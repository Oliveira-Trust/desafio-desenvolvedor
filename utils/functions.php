<?php

    session_start();

    function siteHeader() {
        ?>
        <!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <title>Oliveira Trust - Loja</title>
            <link rel="shortcut icon" href="https://lh6.googleusercontent.com/-0jFR2RwMvJ8/AAAAAAAAAAI/AAAAAAAAAAA/EAkPfsbjPQo/s44-p-k-no-ns-nd/photo.jpg" />
            <!-- CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
            <link rel="stylesheet" href="../css/style.css" />
            
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="../js/ajax.js"></script>
            <script src="../js/cadastro.js"></script>
            <script src="../js/login.js"></script>
            <script src="../js/purchaseOrder.js"></script>

        </head>
        <body>
            <?php
    }

    function siteFooter() {
        ?>
        <!-- Bootstrap -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        </body>
        </html>
        <?php
    }

    // Verifica se o usuário está logado
    function isLogged() {
        if (isset($_SESSION['user']['id']) && isset($_SESSION['user']['name']) 
            && isset($_SESSION['user']['email'])) {
            return true;
        }

        return false;
    }

    // Barra de navegação responsiva ao logar no sistema
    function navBar() {
        ?>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Oliveira Trust</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPedidosCompra" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pedidos de Compra</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownPedidosCompra">
                            <a class="dropdown-item" href="purchaseOrderRegister.php">Cadastrar</a>
                            <a class="dropdown-item" href="purchaseOrderList.php">Listar</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownClientes" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Clientes</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownClientes">
                            <a class="dropdown-item" href="#">Cadastrar</a>
                            <a class="dropdown-item" href="#">Listar</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownProdutos" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Produtos</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownProdutos">
                            <a class="dropdown-item" href="#">Cadastrar</a>
                            <a class="dropdown-item" href="#">Listar</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../utils/logout.php">
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    <?php

    }

    ?>