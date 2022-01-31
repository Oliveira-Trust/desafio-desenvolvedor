<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $config = Config::findOrFail(env('CONFIG_ID', 1));
        return view('home.index', ['title' => trans('home.title'), 'config' => $config]);
    }
}
