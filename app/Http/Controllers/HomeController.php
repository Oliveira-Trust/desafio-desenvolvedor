<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConversionRequest;
use App\Http\Services\ConversionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConversionRequest $request, ConversionService $service)
    {
        $request = $request->validated();

        $conversion = $service->conversion($request);

        return view('/home', ['data' => $conversion]);
    }
}
