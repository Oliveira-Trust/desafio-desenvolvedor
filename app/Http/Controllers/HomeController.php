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

        try {
            $conversion = $service->conversion($request);
        } catch (\Throwable $e) {
            return back()->withError($e->getMessage())->withInput();
        }

        return view('/home', ['data' => $conversion]);
    }
}
