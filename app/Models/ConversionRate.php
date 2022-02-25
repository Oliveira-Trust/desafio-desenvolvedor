<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConversionRate extends Model
{
    use HasFactory;

    public const BIGGER_TO = 'bigger_then';
    public const LESS_TO = 'less_then';

    protected $table = 'conversion_rates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'value',
        'conditional',
        'rate',
    ];

    protected $appends = [
        'conditional_name',
    ];

    /**
     * Returns the text of the selected conditional
     *
     */
    public function getConditionalNameAttribute()
    {
        $conditionals = [
            self::BIGGER_TO => 'Se o valor for maior que',
            self::LESS_TO => 'Se o valor for menor que',
        ];

        return $conditionals[$this->conditional];
    }

    /**
     * Return conversion rate
     * @param float $amount
     * @return float
     */
    public static function getConversionRate(float $amount): float
    {
        $bigger_then = self::where('conditional', self::BIGGER_TO)->first();
        $less_then = self::where('conditional', self::LESS_TO)->first();

        if ($amount >= $bigger_then->value) {
            return $bigger_then->rate;
        }

        return $amount < $less_then->value ? $less_then->rate : 0;
    }
}
