<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExchangeFeeRequest;
use App\Models\ExchangeFee;
use Illuminate\Http\Request;

class ExchangeFeeController extends Controller
{
    public function index()
    {
        return response()->json(ExchangeFee::all());
    }

    public function update(ExchangeFeeRequest $request)
    {
       $data = collect($request->all());

       return $data->map(function ($item) {
           return tap(ExchangeFee::find($item['id']), function ($fee) use ($item) {
               $fee->fill($item)->save();
           });
       });
    }
}
