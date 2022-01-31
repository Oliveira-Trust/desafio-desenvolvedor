<?php

namespace App\Repositories;

class CurrencyRepository
{
    const API_URL = 'http://economia.awesomeapi.com.br';
    const TX_BOLETO = 1.45;
    const TX_CARTAO = 7.63;

    private static $instance;

    public static function getInstance(){
        if(!isset(self::$instance)){
            $c = __CLASS__;
            self::$instance = new $c();
        }

        return self::$instance;
    }

    public function convert($request) {

        $amount = $request->amount ? $request->amount : 1;
        $payment_mode = $request->payment_mode;
        $from_currency = urlencode($request->from_currency);
        $to_currency = urlencode($request->to_currency);
        $query = "{$to_currency}-{$from_currency}";

        $json = file_get_contents(self::API_URL."/json/last/$query");

        $obj = json_decode($json, true);

        $val = $obj[str_replace('-', '', $query)];

        $total_sem_taxa = $amount / $val['bid'];

        $tx_pgto = $payment_mode == 'cartao' ? self::TX_CARTAO : self::TX_BOLETO;
        $vl_tx_pgto = ($amount * $tx_pgto) / 100;
        $total = $total_sem_taxa - $vl_tx_pgto;

        $tx_conv = $amount <= 3000 ? 2 : 1;
        $vl_tx_conv = ($amount * $tx_conv) / 100;
        $total = $total - $vl_tx_conv;

        $data = array();
        $data['moeda_origem'] = $from_currency;
        $data['moeda_destino'] = $to_currency;
        $data['valor_para_conv'] = $amount;
        $data['forma_pagamento'] = $payment_mode == 'cartao' ? 'Cartão de crédito' : 'Boleto';
        $data['valor_moeda_para_conv'] = $val['bid'];
        $data['valor_comprado'] = number_format($total, 2, '.', '');
        $data['taxa_pgto'] = number_format($vl_tx_pgto, 2, '.', '');
        $data['taxa_conv'] = number_format($vl_tx_conv, 2, '.', '');
        $data['valor_utilizado_conv'] = number_format(($amount - $vl_tx_pgto - $vl_tx_conv), 2, '.', '');

        $output = '<div>
                        <span class="h5">Moeda de origem: '.$data['moeda_origem'].'</span>
                    </div>
                    <div>
                        <span class="h5">Moeda de destino: '.$data['moeda_destino'].'</span>
                    </div>
                    <div>
                        <span class="h5">Valor para conversão: '.$data['valor_para_conv'].'</span>
                    </div>
                    <div>
                        <span class="h5">Forma de pagamento: '.$data['forma_pagamento'].'</span>
                    </div>
                    <div>
                        <span class="h5">Valor usado para conversão: '.$data['valor_moeda_para_conv'].'</span>
                    </div>
                    <div>
                        <span class="h5">Valor comprado (com taxas): '.$data['valor_comprado'].'</span>
                    </div>
                    <div>
                        <span class="h5">Taxa de pagamento: '.$data['taxa_pgto'].'</span>
                    </div>
                    <div>
                        <span class="h5">Taxa de conversão: '.$data['taxa_conv'].'</span>
                    </div>
                    <div>
                        <span class="h5">Valor para conversão (descontado as taxas): '.$data['valor_utilizado_conv'].'</span>
                    </div>';

        return $output;
        //return $data;
    }
}
