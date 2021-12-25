<?php
function env($name, $default = '') {
    return getenv($name ?? $default);
}
function putOnEnv(){
    $variaveis = parse_ini_file(__DIR__.'/../.env');
    foreach($variaveis as  $key => $value) {
        putenv("{$key}={$value}");
    }
}
putOnEnv();