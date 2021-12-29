<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__. '/config/config.php'; 

try {
    require __DIR__ . '/routes/routes.php';
} catch(\Exception $e){
    echo $e->getMessage();
}