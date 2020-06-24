<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Response\JsonResponse;

class SiteController extends Controller
{
    /**
     * Show the application website.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Show the api test.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function apiTeste(Request $request)
    {
        return JsonResponse::success(true, 'chegou aqui', $request->all());
    }
}
