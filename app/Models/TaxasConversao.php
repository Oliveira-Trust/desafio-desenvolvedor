<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxasConversao extends Model
{
    use HasFactory;

    public const MAIOR_PARA = 'maior';
    public const MENOR_PARA = 'menor';

    protected $table = "taxas_conversao";
    protected $primaryKey = 'id';
    protected $fillable = [
        'valor',
        'tipo',
        'taxa'
    ];

    public $getMoedaOrigem = [
        'BRL'   => 'BRL'
    ];

    public $getMoedaDestino = [
        'USD'   => 'USD',
        'EUR'   => 'EUR',
    ];

    public static function getTaxaConversao(float $valor): float
    {
        $maior = self::where('tipo', self::MAIOR_PARA)->first();
        $menor = self::where('tipo', self::MENOR_PARA)->first();

        if ($valor >= $maior->valor) {
            return $maior->taxa;
        }

        return $valor < $menor->valor ? $menor->taxa : 0;
    }
}
