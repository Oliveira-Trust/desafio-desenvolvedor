<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CoinConvertionRequest;
use App\Models\CoinConvertion;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CoinConvertionControllerApi extends Controller
{
    /**
     * Make currency convertion
     */
    public function convertCoin(CoinConvertionRequest $request)
    {
        // if ($validator->fails()) {
        //     return $validator;
        // }
        return [request()->input(), $this->getCurrentQuote(null)];
    }

    private function getCurrentQuote(CoinConvertion $coinConvertion)
    {

        $client = new \GuzzleHttp\Client;
        $res = $client->get(
            $coinConvertion->config->api_uri .
            $coinConvertion->origin_coin . '-' . $coinConvertion->destin_coin
        );

        return json_decode($res->getBody()->getContents())->BRLUSD->ask;

    }
}
