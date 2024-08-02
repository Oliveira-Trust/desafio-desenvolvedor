<?php

namespace App\Http\Controllers;

use App\Actions\Conversion\Converter;
use App\Http\Requests\ConverterRequest;
use Illuminate\Contracts\View\View;

class ConverterController extends Controller
{
    public function convert(ConverterRequest $request): View
    {
        return view('converter',
            $this->getConverterData($request->validated())
        );
    }

    public function appConvert(ConverterRequest $request): View
    {
        return view('app.converter',
            $this->getConverterData($request->validated())
        );
    }

    private function getConverterData(array $data): array
    {
        if (! array_key_exists('amount', $data)) {
            return [];
        }

        return Converter::run(
            $data['amount'],
            'BRL',
            $data['destination'],
            $data['payment_method']
        );
    }
}
