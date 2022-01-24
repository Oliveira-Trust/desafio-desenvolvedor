<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentMethodsFeeRequest;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodsFeeController extends Controller
{
    public function index()
    {
        return response()->json(PaymentMethod::all());
    }

    public function update(PaymentMethodsFeeRequest $request)
    {
        $data = collect($request->all());

        return $data->map((function ($value) {
           return tap(PaymentMethod::whereSlug($value['slug'])->firstOrFail(), function ($paymentMethod) use ($value) {
               $paymentMethod->fill(['fees' => $value['fees']])->save();
            });
        }));
    }
}
