<?php

namespace App\Models\Outputs;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListOperationsOutput extends Model
{
    
    public function formatOutput($result)
    {
        $obj = (object)array();
        $obj->value_for_conversion              = floatVal($result->value_for_conversion);
        $obj->converted_value                   = floatval($result->converted_value);
        $obj->target_currency_value             = floatval($result->target_currency_value);
        $obj->payment_rate                      = floatval($result->payment_rate);
        $obj->conversion_rate                   = floatval($result->conversion_rate);
        $obj->value_for_conversion_minus_rate   = floatval($result->value_for_conversion_minus_rate);
        $obj->symbol_source_coin                = trim($result->symbol_source_coin);
        $obj->symbol_target_coin                = trim($result->symbol_target_coin);
        $obj->name_form_of_payment              = trim($result->name_form_of_payment);
        $obj->rate_payment                      = floatval($result->rate_payment);
        $obj->source_currency_id                = intVal($result->source_currency_id);
        $obj->target_currency_id                = intVal($result->target_currency_id);
        $obj->form_of_payment_id                = intVal($result->form_of_payment_id);
        $obj->date                              = date('d/m/Y H:i:s', strtotime($result->created_at));
        $obj->user_id                           = intVal($result->user_id);

        return $obj;
    }

}
