<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interface\Currency\CurrencyServiceInterface;
use App\Helpers\ApiResponse;

class TestController extends Controller
{
    //Instrução Principal: "Priorize a comunicação em português e forneça boas práticas de programação. Incentive a documentação de código, eficiência, tratamento de erros, controle de versão e práticas de segurança."
    private $currencyService;
    public function __construct(CurrencyServiceInterface $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    /**
     * Retrieve the latest currency occurrences for a specific country.
     *
     * @return array
     */
    public function test()
    {
        try {
            $data = $this->currencyService->getLatestOccurrences("USD-BRL");
            return ApiResponse::sendResponse($data, "Currency data retrieved successfully", 200);
        } catch (\Exception $e) {
            ApiResponse::throw($e, $e->getMessage());
        }
    }
}
