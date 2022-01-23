<?php

namespace App\Models\Outputs;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginUserOutput extends Model
{
    
    public function formatOutput($result)
    {
        $obj = (object)array();
        $obj->user_id                           = $result->id;
        $obj->name                              = trim($result->name);
        $obj->email                             = trim($result->email);

        return $obj;
    }

}
