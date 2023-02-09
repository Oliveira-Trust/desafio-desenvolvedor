<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ConversionService;
use App\Http\Resources\ConversionResource;
use App\Http\Requests\Conversion\ConversionRequest;


class ConversionController extends Controller
{

    /**
     * @var ConversionService
     */
    protected $service;


    public function __construct(
        ConversionService $service
    ) {
        $this->service = $service;
    }

    /**
     * @param App\Http\Requests\Conversion\ConversionRequest $request
     * @return array
     */
    public function convert(ConversionRequest $request)
    {
        return new ConversionResource(
            $this->service->convert($request->all())
        );
    }
}
