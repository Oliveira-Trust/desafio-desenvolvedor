<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    public static function getDefaultCurrency(){      
        $model = (new static)::where('default', '1');
        if($model){
          return $model->first();
        }else{
          return false;
        }
      }
}
