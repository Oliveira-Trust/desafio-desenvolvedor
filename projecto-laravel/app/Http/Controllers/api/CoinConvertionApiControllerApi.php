<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CoinConvertion;
use App\Models\Config;

class CoinConvertionControllerApi extends Controller
{
    public function convertCoin() {
        return ["ok", request()->input()];
    }
}
