<?php

    include_once(__DIR__ . '/utils/functions.php');

    if (!isLogged()) {
        header('Location: views/login.php');
    } else {
        header('Location: views/purchaseOrderList.php');
    }

    ?>