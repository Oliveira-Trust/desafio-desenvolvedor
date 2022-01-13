<?php

namespace App\Models;

use App\Mail\OrderShipped;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class ConversionHistory extends Model
{
    protected $fillable = [
        "id",
        "user_id",
        "coin_to",
        "money",
        "type_payment",
        "price_money",
        "converted_money",
        "payment_rate",
        "cost_conversion",
        "money_convert",
        "craeted_at",
        "updated_at",
    ];

    public static function insertHistory( $data )
    {
        $exist = self::query()
            ->where('money', $data['money'])
            ->where('price_money', $data['price_money'])
            ->where('type_payment', $data['type_payment'])
            ->first();
            
        if(!$exist){
            self::create($data);

            $subject = "Conversão de moeda " . $data['coin_to'];
            $description = '<p>Consulta feita em %s</p><ul>
                <li>Moeda de origem: BRL</li>
                <li>Moeda de destino: %s</li>
                <li>Valor para conversão: %s</li>
                <li>Forma de pagamento: %s</li>
                <li>Valor da "moeda" usado para conversão: %s</li>
                <li>Valor comprado: %s</li>
                <li>Taxa de pagamento: %s</li>
                <li>Valor de conversão: %s</li>
                <li>Valor utilizado para conversão já com desconto: %s</li>
            </ul>';

            $description = sprintf($description, date('d/m/Y H:i'), $data['coin_to'], $data['money'], $data['type_payment'], $data['price_money'], $data['converted_money'], $data['payment_rate'], $data['cost_conversion'], $data['money_convert']);

            Mail::to(auth()->user()->email)->send(new OrderShipped($subject, $description));
        }
    }

    public static function getHistoryByUser( $userId )
    {
        return self::query()
            ->where('user_id', $userId)
            ->orderBy('id', 'desc')
            ->paginate(5);
    }

    public function getDate()
    {
        $date = new DateTime($this->craeted_at);

        return $date->format('d/m/Y');
    }
}
