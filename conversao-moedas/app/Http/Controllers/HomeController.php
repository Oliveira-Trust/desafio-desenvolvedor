<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiService;

class HomeController extends Controller
{
    public function index()
    {
        $moedas = collect(ApiService::getAll());
        $listaMoedas = $moedas->map(function ($item) {
            $item = $item['name'];
            return $item;
        })->all();

        return view('home', ['moedas' => $listaMoedas]);
    }
}
