<?php

namespace App\Http\Controllers;

use App\OrderProducts;
use Illuminate\Http\Request;

class OrderProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
     * @param  \App\OrderProducts  $orderProducts
     * @return \Illuminate\Http\Response
     */
    public function show(OrderProducts $orderProducts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrderProducts  $orderProducts
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderProducts $orderProducts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrderProducts  $orderProducts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderProducts $orderProducts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrderProducts  $orderProducts
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderProducts $orderProducts)
    {
        //
    }
}
