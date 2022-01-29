<?php

namespace App\Http\Controllers;

use App\Http\Resources\CoinCollection;
use App\Models\Coin;
use Illuminate\Support\Facades\Cache;

class CoinController extends Controller
{
    public function index()
    {
        return Cache::get('coins', fn () => new CoinCollection(Coin::all()));
    }
}
