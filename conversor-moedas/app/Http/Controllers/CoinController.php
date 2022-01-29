<?php

namespace App\Http\Controllers;

use App\Actions\CoinListAction;
use Illuminate\Http\Request;

class CoinController extends Controller
{
    public function index(Request $request)
    {
        return (new CoinListAction())->execute($request->get('with', ''));
    }
}
