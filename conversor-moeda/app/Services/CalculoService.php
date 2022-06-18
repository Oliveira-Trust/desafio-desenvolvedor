<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CalculoService
{

    public static function calculoConversao($valor_real, $taxa_pgto, $taxa_conversao, $consulta_api, $moeda, $user_id, $forma_pgto)
    {
        try {

            // Realiza todos os calculos e guarda separadamente no obj.
            $ret = new \stdClass;
            $ret->created_at = Carbon::now()->toDateTimeString();
            $ret->valor_real = $valor_real;
            $ret->moeda = $moeda;
            $ret->taxa_pgto = $taxa_pgto;
            $ret->taxa_conversao = $taxa_conversao;
            $ret->valor_moeda = $consulta_api['bid'];
            $ret->valor_moeda = number_format($ret->valor_moeda, 2, '.', '');
            $ret->valor_taxa_conversao = ($valor_real * $taxa_conversao) / 100;
            $ret->valor_taxa_conversao = number_format($ret->valor_taxa_conversao, 2, '.', '');
            $ret->valor_taxa_pgto = ($valor_real * $taxa_pgto) / 100;
            $ret->valor_taxa_pgto = number_format($ret->valor_taxa_pgto, 2, '.', '');
            $ret->valor_para_conversao = $valor_real - $ret->valor_taxa_conversao - $ret->valor_taxa_pgto;
            $ret->valor_convertido = $ret->valor_para_conversao / $ret->valor_moeda;
            $ret->valor_convertido = number_format(floatval($ret->valor_convertido), 2, '.', '');

            // Caso o usuário tenha feito login, então salvamos os resultados no banco de dados
            if ($user_id != "null") {
                CalculoService::salvarConversao($ret, $user_id, $forma_pgto);
            }

            return [$ret];
        } catch (\Throwable $th) {
            $ret->msg = $th;
            return $ret;
        }
    }


    public static function salvarConversao($ret, $user_id, $forma_pgto)
    {
        // Salva as informações no banco de dados
        // Importante salvar todas as informações de taxas e valores separados e não só os resultados das operações pois esses valores podem mudar 
        //  e dai então não se perde o retrato do momento
        try {
            DB::beginTransaction();

            $up =  DB::table('historico_conversoes')->insert([
                'user_id' => $user_id,
                'valor_real' => floatval($ret->valor_real),
                'valor_moeda' => floatval($ret->valor_moeda),
                'moeda' => $ret->moeda,
                'taxa_conversao' => floatval($ret->taxa_conversao),
                'valor_taxa_conversao' => floatval($ret->valor_taxa_conversao),
                'forma_pgto' => $forma_pgto,
                'taxa_pgto' => floatval($ret->taxa_pgto),
                'valor_taxa_pgto' => floatval($ret->valor_taxa_pgto),
                'valor_para_conversao' => floatval($ret->valor_para_conversao),
                'valor_convertido' => floatval($ret->valor_convertido),
                'created_at' => Carbon::now()
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            var_dump($th);
            DB::rollBack();
        }
    }
}
