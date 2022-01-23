<?php

namespace App\Models\Entries;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ConvertCurrencyEntry extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "value_for_conversion",
        "source_currency_id",
        "target_currency_id",
        "form_of_payment_id",
        "user_id",
    ];

    public function __construct(Request $entry){
        if($entry->value_for_conversion >= 1000.00 && $entry->value_for_conversion <= 100000.00){
            $this->value_for_conversion   = floatVal($entry->value_for_conversion);
            $this->source_currency_id     = intVal($entry->source_currency_id);
            $this->target_currency_id     = intVal($entry->target_currency_id);
            $this->form_of_payment_id     = intVal($entry->form_of_payment_id);
            $this->user_id                = intVal($entry->user_id);
        }else{
            throw new \Exception("Invalid value, the value for conversion must be greater than or equal to BRL 1.000,00 and less than or equal to BRL 100.000,00.");
        }
    }
}
