<?php

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
        </head>
        <body>
            <?php
    }

    function siteFooter() {
        ?>
        <!-- Bootstrap -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        
        <!-- handle requests -->
        <!--<script type="text/javascript" src="js/requests.js"></script>-->
        </body>
        </html>
        <?php
    }

    // Verifica se o usuário está logado
    function isLogged() {
        if (isset($_SESSION['user']['name']) && isset($_SESSION['user']['email']) && isset($_SESSION['user']['senha'])) {
            return true;
        }

        return false;
    }

    // Restringe acesso a página para que somente usuários logados tenham acesso
    function restrictedPage() {
        if (!isLogged()) {
            header('Location: /controllers/LoginController.php?');
        }
    }

?>