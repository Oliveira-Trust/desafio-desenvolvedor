<?php

if (!function_exists("errorLog"))
{
    function errorLog($msg, $code) : ? array
    {
        \Log::debug('[Error code:'.$code.'] [Description:'. $msg.']');
        return ['msg' => 'Aconteceu um erro interno e estamos investigando. CODE: '.$code];
    }
}