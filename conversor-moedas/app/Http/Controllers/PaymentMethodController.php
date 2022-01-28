<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentMethodCollection;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Cache;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Cache::get('payment-methods', fn () => new PaymentMethodCollection(PaymentMethod::all()));
    }
}
