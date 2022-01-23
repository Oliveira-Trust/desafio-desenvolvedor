<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyConversionRequest;
use App\Models\CurrencyConversion;

use App\Repositories\Contracts\ConvertedValueRepository;
use App\Services\ConvertValue\ConvertValueInterface;

use DataTables;

class CurrencyConversionController extends Controller
{

    function __construct()
    {
        $this->middleware('role:Currency Conversion view', ['only' => ['index','show']]);
        $this->middleware('role:Currency Conversion create', ['only' => ['create','store']]);
        $this->middleware('role:Currency Conversion edit', ['only' => ['edit','update']]);
        $this->middleware('role:Currency Conversion delete', ['only' => ['destroy']]);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('CurrencyConversion/Index');
        
    }

    /**
     * Create datatable
     *
    */
    
    public function DataTable()
    {

        $Data   = CurrencyConversion::Datatable();
        return  Datatables::of($Data)->editColumn('created_at', function($data) {
            return \Carbon\Carbon::parse($data->created_at)->format('d/m/y - h:i:s');
        })->make();

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        
        $CurrencyList   = CurrencyConversion::CurrencyList();
        $PaymentMethodList  =  CurrencyConversion::PAYMENT_METHOD;
        return view('CurrencyConversion/Create', compact(['CurrencyList', 'PaymentMethodList']));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CurrencyConversionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CurrencyConversionRequest $request, ConvertValueInterface $service)
    {

        try {

            $ConvertValue = $service->setParams($request->all())->handle();
            
            \Mail::to(\Auth::user()->email)->send(new \App\Mail\SendMailConvertValue($ConvertValue));
            return  $this::show($ConvertValue->id);
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
        
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CurrencyConversion  $currencyConversion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   

        $PaymentMethodList  = CurrencyConversion::PAYMENT_METHOD;
        $Dados              = CurrencyConversion::findOrFail($id);
        $CurrencyList       = CurrencyConversion::CurrencyList();
        return view('CurrencyConversion/View', compact(['Dados', 'CurrencyList', 'PaymentMethodList']));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CurrencyConversion  $currencyConversion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $PaymentMethodList  = CurrencyConversion::PAYMENT_METHOD;
        $Dados              = CurrencyConversion::findOrFail($id);
        $CurrencyList       = CurrencyConversion::CurrencyList();
        return view('CurrencyConversion/Edit', compact(['Dados', 'CurrencyList', 'PaymentMethodList']));
        
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CurrencyConversionRequest  $request
     * @param  \App\Models\CurrencyConversion  $currencyConversion
     * @return \Illuminate\Http\Response
     */
    public function update(CurrencyConversionRequest $request,$id, ConvertValueInterface $service)
    {
        try {
            
            $ConvertValue = $service->setParams($request->all())
            ->setId($id)
            ->handle();

            \Mail::to(\Auth::user()->email)->send(new \App\Mail\SendMailConvertValue($ConvertValue));
            return  $this::show($id);
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CurrencyConversion  $currencyConversion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        CurrencyConversion::destroy($id);
        return view('CurrencyConversion/Index');
    }
}
