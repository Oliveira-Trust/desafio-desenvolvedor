<?php
namespace App\Http\Infrastructure\Repositories;

use App\Models\Conversion;
use App\Domain\Repositories\ConversionRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class ConversionRepository implements ConversionRepositoryInterface
{
       public function create(Array $paramsToConversion): Conversion{
    
    $conversion = Conversion::create([
             'origin_currency' => 'BRL',
             'destination_currency' => $paramsToConversion['destination_currency'],
             'conversion_value' => $paramsToConversion['conversion_value'],
             'payment_method_id' => $paramsToConversion['payment_method_id'],
             'user_id'=> Auth::user()->id,
             'conversion_fee' => $paramsToConversion['conversion_fee'],
             'payment_tax' => $paramsToConversion['payment_tax'],
             'total_amount_origin_currency' => $paramsToConversion['total_amount_origin_currency'],
             'total_amount_destination_currency' => $paramsToConversion['total_amount_destination_currency'],

         ]);

        return $conversion;
    }

    public function getConversionHistory(int $userId): Array
    {
         $conversions = Conversion::where('user_id', $userId)->get();
         if ($conversions->isEmpty()) {
            return ['message' => 'Nenhuma conversão encontrada para o usuário.'];
        }
        return $conversions->toArray();
    }
}