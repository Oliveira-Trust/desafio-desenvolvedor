<?php
namespace App\Http\Infrastructure\Repositories;

use App\Models\Conversion;
use App\Domain\Repositories\ConversionRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class ConversionRepository implements ConversionRepositoryInterface
{
    public function create(string $origin_currency,  string $destination_currency, float $conversion_value, float $converted_value, string $payment_method){
    
    $conversion = Conversion::create([
             'origin_currency' => 'BRL',
             'destination_currency' => $destination_currency,
             'conversion_value' => $conversion_value,
             'converted_value' => $converted_value,
             'payment_method' => $payment_method,
             'user_id'=> Auth::user()->id,
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