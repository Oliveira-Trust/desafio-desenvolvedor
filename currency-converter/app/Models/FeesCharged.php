<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeesCharged extends Model
{
    protected $fillable = [
        "id",
        "user_id",
        "money_min",
        "money_max",
        "fee_ticket",
        "fee_card",
        "parameter_money",
        "fee_below",
        "fee_above",
        "craeted_at",
        "updated_at",
    ];

    protected $table = 'fees_charged';

    public static function updateOrCreateByUser($userId, $data)
    {
        $fees = self::query()->where('user_id', $userId)->first();

        if(!$fees){
            $data += ['user_id' => $userId];
            self::create($data);
        }else{
            $fees->update($data);
        }
    }
}
