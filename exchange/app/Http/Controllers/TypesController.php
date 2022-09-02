<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;

class TypesController extends Controller
{
    public function index()
    {
        return Http::async()->get('http://nginx-quotation:82/api/types')->wait()->body();
    }
}
