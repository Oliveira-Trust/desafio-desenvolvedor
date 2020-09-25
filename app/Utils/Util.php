<?php

namespace App\Utils;

class Util
{
    public static function formataDataParaUs($dt)
    {
        $dt = explode('/', $dt);
        return $dt[2] . '-' . $dt[1] . '-' . $dt[0];
    }

    public static function diferencaHoras(\DateTime $datatime1, \DateTime $datatime2){
        $data1  = $datatime1->format('Y-m-d H:i:s');
        $data2  = $datatime2->format('Y-m-d H:i:s');

        $diff = $datatime1->diff($datatime2);
        $horas = $diff->h . ':' . $diff->i . ':' . $diff->s;

        return $horas;
    } 

    public static function converterRealParaDecimal($txt){
        $txt = str_replace(".", "", $txt);
        $txt = str_replace(",", ".", $txt);
        return $txt;
    }

    public static function converterDecimalParaReal($txt){
        $txt = 'R$' . number_format($txt, 2, ',', '.');
        return $txt;
    }
}