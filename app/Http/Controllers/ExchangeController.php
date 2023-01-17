<?php

namespace App\Http\Controllers;

use App\Domains\Exchange\Services\ExchangeService;
use App\Http\Requests\ExchangeRequest;
use App\Http\Resources\ExchangeResource;
use Illuminate\Support\Facades\Auth;

class ExchangeController
{
    public function __construct(public ExchangeService $exchangeService)
    {
    }

    public function create(ExchangeRequest $request)
    {
        try {
            return ExchangeResource::make($this->exchangeService->createExchange($request->toDTO()));
        } catch (\Exception $exception) {
            return response()->json([
                "msg" => $exception->getLine() . " " .$exception->getFile()
            ], 500);
        }
    }

    public function list()
    {
        try{
            $user_id = Auth::user()->id;
            return response()->json($this->exchangeService->listExchange($user_id));
        }catch (\Exception $exception){
            return response()->json([
                "msg" => $exception->getMessage()
            ], 500);
        }

    }

}
