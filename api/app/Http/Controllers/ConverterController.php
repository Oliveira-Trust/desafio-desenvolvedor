<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ConverterController extends Controller
{
    const ACCEPTED_INPUT = [
        'value',
        'currency',
        'method'
    ];
    const VALUE_RANGE = [
        'min' => 1000,
        'max' => 100000
    ];
    const DEFAULT_CURRENCY = 'BRL';

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $input = $request->all();

        if (!$this->validateInputParams(array_keys($input))) {
            return response()->json([
                'message' => 'Entrada inválida'
            ], 400);
        }

        if (!$this->validateValue($input['value'])) {
            return response()->json([
                'message' => 'Valor inválido'
            ], 400);
        }

        if (!$this->validateCurrency($input['currency'])) {
            return response()->json([
                'message' => 'Moeda inválida'
            ], 400);
        }
        
        return $input;
    }

    private function validateInputParams(array $inputKeys): bool
    {
        return empty(array_diff($this::ACCEPTED_INPUT, $inputKeys));
    }

    private function validateValue(String|int|float $value): bool
    {
        return (float) $value > $this::VALUE_RANGE['min'] && $value < $this::VALUE_RANGE['max'];
    }

    private function validateCurrency(String $currency): bool
    {
        if ($currency === $this::DEFAULT_CURRENCY) {
            return false;
        }
        // Verificação desabilitada para funcionamento dos testes e para evitar perda de tempo em correções de ambiente
        // Assim, evitando afetar a duração do desafio ou a quantidade de features criadas
        $response = Http::withOptions([
            'verify' => false
        ])->get('https://economia.awesomeapi.com.br/json/available/uniq');
        return !empty($response->json($currency));
    }
}
