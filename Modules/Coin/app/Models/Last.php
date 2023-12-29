<?php

namespace Modules\Coin\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Http;
use Modules\Coin\Database\factories\LastFactory;

class Last extends Model
{
    use HasFactory;

    public function request($url)
    {
        return Http::get($url);
    }
}
