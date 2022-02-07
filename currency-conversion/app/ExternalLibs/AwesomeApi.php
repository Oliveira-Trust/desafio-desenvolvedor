<?php

namespace App\ExternalLibs;

class AwesomeApi{

  public static function getCoinNames(){

    return self::goAwesomeApi("https://economia.awesomeapi.com.br/json/available/uniq");
  }

  public static function getCoinConversion($coinFrom, $coinTo)
  {

    return self::goAwesomeApi("https://economia.awesomeapi.com.br/last/".$coinTo.'-'. $coinFrom);
    
  }

  public function AvailabeConversion(){

    return simplexml_load_file("https://economia.awesomeapi.com.br/xml/available");

  }

  private static function goAwesomeApi($url){

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $output = curl_exec($ch);
    curl_close($ch);

    return $output;

  }

}