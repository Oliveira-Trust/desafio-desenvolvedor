<?php

use Illuminate\Contracts\Routing\ResponseFactory;
use Symfony\Component\HttpFoundation\Response as HttpFoundation;

if(!function_exists('retorno')) {
    function retorno($dados = [], $statusCode = 200, $mensagem = null, $error = null, array $headers = [], $options = 0){
        $retorno = [];
        $retorno['statusCode'] = $statusCode;
        $retorno['data'] = $dados;
        if(!empty($mensagem)){
            $message = $mensagem;
        }else{
            $message = HttpFoundation::$statusTexts[$statusCode];
        }
        $retorno['message'] = $message;
        if(!empty($error)){
            $retorno['error'] = $error;
        }
        return Response::json($retorno, $statusCode, [], JSON_PRETTY_PRINT);
    }
}

/**
 * https://stackoverflow.com/questions/20771239/how-to-display-a-readable-array-laravel
 * 
 */
if(!function_exists('debugLaravel')) {
    function debugLaravel($var){
        array_map(function($var) { 
            print_r($var); 
        }, func_get_args()); 
        die;
    }
}

/**
 * https://stackoverflow.com/questions/20771239/how-to-display-a-readable-array-laravel
 * 
 */
if(!function_exists('statusPagamentos')) {
    function statusPagamentos($status){
        switch ($status) {
            case 'pending':
                return 'Pendente';
            break;
            case 'cancelled':
                return 'Cancelado';
            break;
            case 'approved':
                return 'Aprovado';
            break;
            case 'refunded':
                return 'Devolvido';
            break;
        default:
                return 'Desconhecido';
        }
    }
}

if(!function_exists('requisicao')) {
    function requisicao($end_point, $custom_request = 'GET', $dados = []){
        $url = '';
        //json/last/USD-BRL
        $url = 'https://economia.awesomeapi.com.br/';
        $url .= $end_point;
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $custom_request,
            CURLOPT_POSTFIELDS => (!empty($dados) ? json_encode($dados) : [])
        ));
        $retorno = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            $retorno = json_decode($retorno, true);
            return $retorno;
        }
    }
}