<?php

namespace Modules\Coin\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Coin\app\Models\Last;

class CoinController extends Controller
{
    protected Last $last;

    public function __construct(Last $last)
    {
        $this->last = $last;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->_request();
        return view('coin::index', ['data'=> $data]);
    }

    public function _request()
    {
        $url = "https://economia.awesomeapi.com.br/last/USD-BRL,EUR-BRL,BTC-BRL";
        return json_decode($this->last->request($url), true);
    }
}
