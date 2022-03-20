<?php

namespace App\Models\PaymentType;

use App\Models\PaymentType\Billet;
use App\Models\PaymentType\CreditCard;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    use HasFactory;

    /**
     * Neste momento não há a necessidade de ser armazenado em bd
     * mas a estrutura dá muito a crer que futuramente seria pedido
     * para ser inserido um novo tipo e acrescentado e, neste caso é melhor acrescentar
     * no banco do que no código como um enum, por exemplo.
     */
    public static function findAll() {
        return collect([
            new Billet(),
            new CreditCard(),
        ]);
    }

    public static function getAllSlugs() {
        return self::findAll()->map(function($payment) {
            return $payment->getSlug();
        });
    }
}
