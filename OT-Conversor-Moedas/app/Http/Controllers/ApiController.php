<?php

namespace App\Http\Controllers;

use App\Facades\Api;


class ApiController extends Controller
{
    public function __invoke()
    {
        return Api::get('/last/USD-BRL,EUR-BRL,BTC-BRL')->json();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\API  $aPI
     * @return \Illuminate\Http\Response
     */
    public function show(API $aPI)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\API  $aPI
     * @return \Illuminate\Http\Response
     */
    public function edit(API $aPI)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\API  $aPI
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, API $aPI)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\API  $aPI
     * @return \Illuminate\Http\Response
     */
    public function destroy(API $aPI)
    {
        //
    }
}
