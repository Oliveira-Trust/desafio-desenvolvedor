<?php

namespace App\Models;

use App\Services\StringConvertion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyCurrencyModel extends Model
{
    use HasFactory;

    protected $table = 'buy_currency';

    protected $fillable = [
        'payment_type',
        'origin_currency',
        'destination_currency',
        'value',
        'selling_price',
        'convertion_fee',
        'payment_fee',
    ];

    public function __construct(array $attributes = [])
    {
        $attributes = $this->formapAttributeKeys($attributes);
        parent::__construct($attributes);
    }

    private function formapAttributeKeys(array $attributes = []): array
    {
        /**
         * faço por collect por conta que o array_map fica menos legível
         * em questão de performance aqui não faz a mínima diferença
         * */ 
        return collect($attributes)->mapWithKeys(function($value, $keys) {
            return [
                StringConvertion::convertCamelCaseToSnake($keys) => $value
            ];
        })->toArray();
    }
}
