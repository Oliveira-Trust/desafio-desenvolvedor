<?php

namespace App\Http\Controllers;

use App\Models\CoinConvertion;
use App\Models\Config;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $config = Config::findOrFail(env('CONFIG_ID', 1));
        $historic = CoinConvertion::where('user_id', auth()->user()->id)->latest()->limit(10)->get();
        return view('home.index', ['title' => trans('home.title'), 'config' => $config, 'historic' => $historic]);
    }

    public function getRefreshHistoric()
    {
        return view('home.table-historic', [
            'historic' => CoinConvertion::where('user_id', auth()->user()->id)->latest()->limit(10)->get()
        ]);
    }

}
