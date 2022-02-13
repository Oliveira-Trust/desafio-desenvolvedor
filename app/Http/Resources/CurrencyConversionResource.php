<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\CurrencyConversion;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CurrencyConversionResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return
        $this->collection->map(function (CurrencyConversion $item) {

            return [
                'Moeda de origem:'                                          => $item->origin_currency,
                'Moeda de destino:'                                         => $item->destiny_currency,
                'Valor para conversão:'                                     => $item->value_currency,
                'Forma de pagamento: '                                      => $item->form_payment,
                'Valor comprado em "Moeda de destino":'                     => $item->value_destiny_currency,
                'Valor comprado em "Moeda de destino"'                      => $item->value_acquired_in_the_conversation,
                'Taxa de pagamento:'                                        => $item->payment_rate,
                'Taxa de conversão:'                                        => $item->conversion_rate,
                'Valor utilizado para conversão descontando as taxas: '     => $item->value_used_for_conversion
            ];
        })->toArray();
    }
}
