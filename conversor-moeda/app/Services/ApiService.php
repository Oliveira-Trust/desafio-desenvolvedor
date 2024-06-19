<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiService
{
    /**
     * Obter cotação de moeda.
     *
     * @param string $moedaOrigem
     * @param string $moedaDestino
     * @return array
     */
    public function obterCotacao($moedaOrigem, $moedaDestino)
    {
        $url = "https://economia.awesomeapi.com.br/json/last/{$moedaOrigem}-{$moedaDestino}";
        $response = Http::get($url);

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }

    /**
     * Obter o bid de uma moeda específica.
     *
     * @param string $moedaDestino
     * @return float|null
     */
    public function obterBidDestino($moedaDestino)
    {
        $url = "https://economia.awesomeapi.com.br/json/last/{$moedaDestino}";
        $response = Http::get($url);

        if ($response->successful()) {
            $data = $response->json();
            $bidDestinoKey = "{$moedaDestino}BRL"; // Assumindo que o bid do destino está em relação ao BRL
            return $data[$bidDestinoKey]['bid'] ?? null;
        }

        return null;
    }
}
