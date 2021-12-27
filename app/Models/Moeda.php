<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Moeda extends Model
{
    protected $fillable = ['moeda_id','nome','ultima_cotacao'];
    protected $table = 'moedas';

    protected $primaryKey = 'moeda_id';

    protected  $dates = [
        'created_at',
        'updated_at'
    ];

    public static function getMoedaPadrao(){
       return array("BRL");
    }

    public static function getMoedasDisponiveis(){
        return array("USD-BRL","EUR-BRL","GBP-BRL");
    }

    public static function getSimboloMoeda($moeda){

        $simbolo = '';

        switch($moeda){
            case 'USD':
                $simbolo = '$';
                break;
            case 'EUR':
                $simbolo = '€';
                break;
            case 'GBP':
                $simbolo = '£';
                break;
            default:
                $simbolo = 'R$';
                break;
        }

        return $simbolo;
    }

    public static function getTaxas($tipo,$valor){

        $taxaPagamento = 0.0;
        $taxaConversao = 1;

        switch($tipo){
            case 'Boleto':
                $taxaPagamento = 1.45;
            break;
            default:
                $taxaPagamento = 7.63;
            break;
        }

        if($valor < 3000){
            $taxaConversao = 2;
        }

        return array("Taxa_pagamento"=>$taxaPagamento,"Taxa_conversao"=>$taxaConversao);
    }
}
