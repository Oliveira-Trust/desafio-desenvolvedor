<?php

namespace App\Http\Controllers;

use App\Domain\Converter\Services\ConversorMoedaService;
use App\Http\Requests\RequestConversaoMoeda;
use App\Http\Resources\ResponseMessageDefault;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Throwable;

class ConversorMoedaController extends Controller
{
    public function __construct(
        private readonly ConversorMoedaService $conversorMoedaService
    ) {}

    public function index(Request $request): View
    {
        return view('dashboard', [
            'histories' => $this->conversorMoedaService->historico($request->all()),
        ]);
    }

    public function showForm(): View
    {
        return view('converterMoeda.form', [
            'moedas' => ['USD', 'BTC'],
            'formasPagamento' => ['boleto' => 'Boleto', 'credit_card' => 'Cartão de Crédito'],
        ]);
    }

    /**
     * @param RequestConversaoMoeda $requestConversaoMoeda
     * @return JsonResponse
     */
    public function storeConversion(RequestConversaoMoeda $requestConversaoMoeda): JsonResponse
    {
        try {
            $this->conversorMoedaService->converter($requestConversaoMoeda->validated());
            $message = [
                'message' => 'Conversão realizada com sucesso',
            ];

            return (new ResponseMessageDefault($message))->response();
        } catch (Exception $exception) {
            return (new ResponseMessageDefault([
                'message' => 'Ocorreu um erro ao realizar a conversão: '.$exception->getMessage(),
            ]))
                ->response()
                ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (Throwable $throwable) {
            return (new ResponseMessageDefault([
                'message' => 'Erro inesperado: '.$throwable->getMessage(),
            ]))
                ->response()
                ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
