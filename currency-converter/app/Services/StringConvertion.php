<?php

namespace App\Services;

class StringConvertion
{
    public static function convertCamelCaseToSnake(string $camelCase = ''): string
    {
        // Código copiado da internet, mas funcionou lo/
        $pattern = '!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!';
        preg_match_all($pattern, $camelCase, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ?
                strtolower($match) :
                lcfirst($match);
        }
        return implode('_', $ret);
    }
}