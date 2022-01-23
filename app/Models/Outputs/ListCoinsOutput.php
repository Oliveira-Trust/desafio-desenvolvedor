<?php

namespace App\Models\Outputs;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListCoinsOutput extends Model
{
    
    public function formatOutput($result)
    {
        $obj = (object)array();
        $obj->coin_id              = floatVal($result->id);
        $obj->symbol               = $result->symbol;

        return $obj;
    }

}
