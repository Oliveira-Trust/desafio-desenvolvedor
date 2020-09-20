<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $clientService)
    {
        $this->orderService = $clientService;
    }

    public function index()
    {
        //
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        return $this->orderService->update($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->orderService->destroy($id);
    }
}
