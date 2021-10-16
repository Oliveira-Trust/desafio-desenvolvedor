<?php

namespace App\Http\Controllers\Awesome;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BuyController extends Controller
{
    public function buy(Request $request)
    {
        dd($request->all());
    }
}
