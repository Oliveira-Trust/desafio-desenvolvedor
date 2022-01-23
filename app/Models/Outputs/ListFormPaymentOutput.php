<?php

namespace App\Models\Outputs;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListFormPaymentOutput extends Model
{
    
    public function formatOutput($result)
    {
        $obj = (object)array();
        $obj->form_id              = floatVal($result->id);
        $obj->name                 = $result->name;
        $obj->rate                 = $result->rate;

        return $obj;
    }

}
