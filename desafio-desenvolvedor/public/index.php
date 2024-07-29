<?php

ini_set('max_execution_time', 300);

$htmlFilePath = __DIR__ . '/index.html';

if (file_exists($htmlFilePath)) {
    $htmlContent = file_get_contents($htmlFilePath);
    
    echo $htmlContent;
} else {
    http_response_code(404);
    echo "404 Not Found";
}