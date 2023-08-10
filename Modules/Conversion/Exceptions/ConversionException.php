<?php

namespace Modules\Conversion\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class ConversionException extends Exception {

    public function render(): JsonResponse {
        return response()->json(['error' => 'Erro de conversão de moeda'], 400);
    }
}
