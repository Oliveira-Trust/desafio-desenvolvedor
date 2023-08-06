<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidCurrencyException;
use App\Http\Requests\ConversionRequest;
use App\Services\ConversionService;
use Exception;
use Illuminate\Http\Request;

class ConversionController extends Controller
{
    //
    private $conversionService;

    public function __construct() {
        $this->conversionService = new ConversionService();
    }

    public function convert(ConversionRequest $request)
    {
        try {
            return $this->conversionService->convert($request->get('target_coin'), $request->get('payment_method'),
                $request->get('value'), $request->get('source_coin'));
        } catch (InvalidCurrencyException $e) {
            return response()->json(['message'=>$e->getMessage()],422);
        } catch (Exception $e){
            throw $e;
        }
    }
}
