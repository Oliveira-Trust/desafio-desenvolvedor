<?php

namespace App\Http\Controllers;

use App\Http\Requests\Conversion\StoreConversionRequest;
use App\Models\Conversion;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ConversionController extends Controller
{
    public function index(Request $request)
    {
        $conversions = Conversion::with('exchange')
            ->whereHas('exchange.user', function (Builder $query) use (&$request) {
                $query->whereId($request->user()->id);
            });

        return $conversions->first();
    }

    public function store(StoreConversionRequest $request)
    {
        return response($request->store(), 201);
    }
}
