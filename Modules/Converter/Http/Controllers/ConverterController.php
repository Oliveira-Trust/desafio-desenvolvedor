<?php

namespace Modules\Converter\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Modules\Converter\Http\Requests\MakeConversionRequest;
use Modules\Fee\Services\Contracts\FeeServiceInterface;

class ConverterController extends Controller
{
    private $feeService;

    public function __construct(FeeServiceInterface $feeService)
    {
        $this->feeService = $feeService;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('converter::index');
    }

    public function make(MakeConversionRequest $request)
    {
        $valueToConvert = $request->value_to_convert;
        $appliedFees = $this->feeService->applyFees($valueToConvert, $request->payment_method);
        $finalValueToConvert = $appliedFees['final_value'];
    }
}
