<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        $types = Http::async()->get('http://nginx-quotation:82/api/types')->wait()->body();

        return view('home', [
            'types' => json_decode($types, true),
        ]);
    }

    public function cotation(Request $request)
    {
        Http::async()->get('http://nginx-exchange:81/api/async', [
            'source' => $request->get('source'),
            'target' => $request->get('target'),
            'amount' => $request->get('amount'),
            'method' => $request->get('method'),
            'token' => $request->get('token'),
        ])->wait();

        return response()->json(['status' => 'ok'], 201); 
    }

    public function apiCotation(Request $request)
    {
        return Http::async()->get('http://nginx-exchange:81/api', [
            'source' => $request->get('source'),
            'target' => $request->get('target'),
            'amount' => $request->get('amount'),
            'method' => $request->get('method'),
            'token' => $request->get('token'),
        ])->wait()->body();
    }
}
