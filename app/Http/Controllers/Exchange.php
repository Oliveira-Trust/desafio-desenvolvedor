<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HExchange;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class Exchange extends Controller
{
    public function getInput(Request $request)
    {
        $input = $request->all();
        return $this->setChange($input);
    }
    public function setChange($input)
    {

        $valueBought = $input['price'];

        $type = $input['product_cur']['type'];
        $bid = $input['product_cur']['bid'];

        $rateVal = $input['md_payment']['val'];
        $mhdType = $input['md_payment']['type'];
        $val_disMd = $valueBought * $rateVal / 100;

        /*
        Aplicar taxa de 2% pela conversão para valores abaixo de R$ 3.000,00 e 1% para valores maiores que R$ 3.000,00, 
        essa taxa deve ser aplicada apenas no valor da compra e não sobre o valor já com a taxa de forma de pagamento.
        */
        $val_disUpDown = 0;
        if ($val_disMd < 3000.00) {
            $val_disUpDown = $valueBought * 1 / 100;
        } else  if ($val_disMd > 3000.00) {
            $val_disUpDown = $valueBought * 2 / 100;
        }

        $valMhdDiscont = ($valueBought - $val_disMd) - $val_disUpDown;
        $unknow = $valMhdDiscont / $bid;

        if (DB::table('hexchange')->where('cur_destiny', $type)->exists()) {
            DB::table('hexchange')->where('cur_destiny', $type)->update([
                    'cur_origim' => 'BRL',
                    'cur_destiny' => $type,
                    'val_input' => $valueBought,
                    'mhd_payment' => $mhdType,
                    'val_cur_destiny' => $bid,
                    'val_buy' => $unknow,
                    'rate_payment' => $val_disMd,
                    'rate_conversion' => $val_disUpDown,
                    'discont_onversion' => $valMhdDiscont
                ]);
        } else {
            $insertHistory = [
                'cur_origim' => 'BRL',
                'cur_destiny' => $type,
                'val_input' => $valueBought,
                'mhd_payment' => $mhdType,
                'val_cur_destiny' => $bid,
                'val_buy' => $unknow,
                'rate_payment' => $val_disMd,
                'rate_conversion' => $val_disUpDown,
                'discont_onversion' => $valMhdDiscont
            ];
            DB::table('hexchange')->insert($insertHistory);
        }

        return response()->json([
            'cur_origim' => 'BRL',
            'cur_destiny' => $type,
            'val_input' => $valueBought,
            'mhd_payment' => $mhdType,
            'val_cur_destiny' => $bid,
            'val_buy' => $unknow,
            'rate_payment' => $val_disMd, //Taxa de pagamento: R$ 72,50
            'rate_conversion' => $val_disUpDown, //Taxa de conversão: R$ 50,00
            'discont_onversion' => $valMhdDiscont, //Valor utilizado para conversão descontando as taxas: R$ 4.877,50
        ]);
    }
}
