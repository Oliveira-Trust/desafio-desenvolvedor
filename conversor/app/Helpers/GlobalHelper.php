<?php

namespace App\Helpers;

class GlobalHelper
{
    public static function getBid($string) {
        $bid = explode('|', $string)[1];
        return floatval($bid);
    }

    public static function getCifrao($string) {
        return $string = explode('|', $string)[0];
    }

    public static function limpaValor($valor) {
        return floatval(str_replace('.', '', $valor));
    }

    public static function formataValorToBR($valor) {
        return number_format($valor, 2, ',', '.');
    }

    public static function formataValorToUS($valor) {
        $valor = str_replace(',', '.', $valor);
        return number_format($valor, 2, '.', ',');
    }
}
