<?php

use App\Helpers\EntityManagerFactory;
require_once __DIR__. '/../config/config.php';
require_once __DIR__ . '/../vendor/autoload.php';

$emFactory = new EntityManagerFactory();
// Define app routes
require_once __DIR__ .'/../routes/routes.php';
// Run app
$app->run();