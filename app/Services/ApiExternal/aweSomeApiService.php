<?php

namespace App\Services\ApiExternal;

use App\Services\ApiExternal\aweSomeApiServiceContract;
use Illuminate\Support\Facades\Http;

class aweSomeApiService implements aweSomeApiServiceContract
{  
     /**
     * Retrieves currency conversion data from an external API.
     *
     * @param string $sourceCurrency The source currency code.
     * @param string $targetCurrency The target currency code.
     * @return array The currency conversion data.
     */
    
    public function currencyConversionData($sourceCurrency, $targetCurrency)
    {
        try {
            $response = Http::get("https://economia.awesomeapi.com.br/json/last/". $sourceCurrency . "-" . $targetCurrency);

            $dataConversion = json_decode($response->getBody(), true);
            $currenciesToConvert = $sourceCurrency . $targetCurrency;
            $dataConversion = $dataConversion[$currenciesToConvert] ?? [];
            
            return $dataConversion;
        } catch (\Throwable $th) {
            return response()->json(['error_code' => 10007, 'error_msg' => 'Error getting response.'], 404);
        }
    }
}