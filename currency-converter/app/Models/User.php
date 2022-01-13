<?php

namespace App\Models;

use App\Providers\NumberServiceProvider;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function feesCharged()
    {
        return $this->hasOne(FeesCharged::class, "user_id", "id");
    }

    public function treatingFeesCharged()
    {
        $feesCharged = $this->feesCharged;

        $data = [
            "money_min"         => "1.000,00",
            "money_max"         => "100.000,00",
            "fee_ticket"        => "1.45",
            "fee_card"          => "7.63",
            "parameter_money"   => "3.000,00",
            "fee_below"         => "2",
            "fee_above"         => "1"
        ];

        if($feesCharged){
            $data = [
                "money_min"         => NumberServiceProvider::floatToMoney($feesCharged->money_min),
                "money_max"         => NumberServiceProvider::floatToMoney($feesCharged->money_max),
                "fee_ticket"        => $feesCharged->fee_ticket,
                "fee_card"          => $feesCharged->fee_card,
                "parameter_money"   => NumberServiceProvider::floatToMoney($feesCharged->parameter_money),
                "fee_below"         => $feesCharged->fee_below,
                "fee_above"         => $feesCharged->fee_above
            ];
        }

        return $data;
    }
}
