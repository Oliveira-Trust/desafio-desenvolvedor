<?php

if(!function_exists('curlGET')){
    function curlGET($url, $headers)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}

if(!function_exists('formatBRL')){
    function formatBRL($value)
    {
        return 'R$ ' . number_format($value, 2, ',', '.');
    }
}

if(!function_exists('formatMoney')){
    function formatMoney($value)
    {
        return '$ ' . number_format($value, 2, ',', '.');
    }
}
