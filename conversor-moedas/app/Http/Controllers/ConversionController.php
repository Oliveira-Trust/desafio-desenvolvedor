<?php

namespace App\Http\Controllers;

use App\Http\Requests\Conversion\StoreConversionRequest;
use App\Http\Resources\ConversionResource;
use App\Models\Conversion;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ConversionController extends Controller
{
    public function index(Request $request)
    {
        $conversions = Conversion::with([
            'exchange',
            'exchange.paymentMethod',
            'coinPrice',
            'coinPrice.coinBase',
            'coinPrice.coinConvert'
        ])
            ->whereHas('exchange.user', function (Builder $query) use (&$request) {
                $query->whereId($request->user()->id);
            })
            ->latest()
            ->get();

        return response($conversions);
    }

    public function store(StoreConversionRequest $request)
    {
        $id = $request->store()->id;

        $conversion = Conversion::with([
            'exchange',
            'exchange.paymentMethod',
            'coinPrice',
            'coinPrice.coinBase',
            'coinPrice.coinConvert'
        ])->find($id);

        return response(new ConversionResource($conversion), 201);
    }
}
