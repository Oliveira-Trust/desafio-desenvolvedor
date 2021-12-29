<?php

use App\Core\Request;

require_once __DIR__ . '/../bootstrap.php';

$request = new Request();
resolve($request, $container);
