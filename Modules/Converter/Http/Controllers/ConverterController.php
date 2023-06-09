<?php

namespace Modules\Converter\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Modules\Converter\Http\Requests\MakeConversionRequest;

class ConverterController extends Controller
{
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
        dd($valueToConvert);
    }
}
