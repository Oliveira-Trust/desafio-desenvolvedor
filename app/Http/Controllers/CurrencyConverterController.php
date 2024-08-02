<?php

namespace App\Http\Controllers;

use App\Enums\Currency;
use App\Http\Requests\CurrencyConvertFormRequest;
use App\Http\Resources\CurrencyConversionPaginationResource;
use App\Http\Resources\CurrencyConversionResource;
use App\Http\Resources\CurrencyResource;
use App\Http\Resources\PaymentMethodResource;
use App\Jobs\SendConversionCurrencyToUserJob;
use App\Models\CurrencyConversion;
use App\Models\PaymentMethod;
use App\Models\User;
use App\Repositories\CurrencyConversionRepository;
use App\Services\CurrencyConversionService;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CurrencyConverterController extends Controller
{
    protected $currencyConversionService;
    


    public function __construct(CurrencyConversionService $currencyConversionService)
    {
        $this->currencyConversionService = $currencyConversionService;



    }

    public function index()
    {

        $paymentMethods = PaymentMethodResource::collection(PaymentMethod::all());

        $currencies = CurrencyResource::collection(Currency::cases());
        
        
        $currencyConversions = CurrencyConversionResource::collection(Auth::user()->currency_conversions()->latest()->take(3)->get());




        return Inertia::render('Dashboard', ['paymentMethods' => $paymentMethods, 'currencies' => $currencies, 'currencyConversions' => $currencyConversions]);
    }
    public function store(CurrencyConvertFormRequest $request)
    {

        $amount = $request->input('amount');
        $destinationCurrency = $request->input('currency_destination');
        $paymentMethod = $request->input('payment_method');


        $result = $this->currencyConversionService->convert($amount, $destinationCurrency, $paymentMethod);

        $currencyConversion = CurrencyConversion::create($result);

        $userAuth = User::find(Auth::user()->id);
        dispatch(new SendConversionCurrencyToUserJob($userAuth, $currencyConversion));

        return to_route('conversao.index');

    }
    public function myConversions()
    {


        $currencyConversions = CurrencyConversionResource::collection(Auth::user()->currency_conversions()->latest()->paginate(3));




        return Inertia::render('MyCurrencyConversions', ['currencyConversions' => $currencyConversions]);
    }
}
