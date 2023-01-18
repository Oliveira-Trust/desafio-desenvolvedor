<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() 
    {
        $coins = Coin::selectRaw('coin_dest,label')->get()->toArray();


        return view('home.index',compact('coins'));
    }
}
