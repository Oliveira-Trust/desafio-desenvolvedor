<?php

namespace App\Http\Controllers;

use App\Http\Resources\DefaultResource;
use App\Http\Requests\CambioRequest;
use App\Service\CambioService;
use \Illuminate\Http\Response;

class CambioController extends Controller
{
    private $response;
    private $message;
    private $statusCode;

    public function __construct()
    {
        $this->message    = "";
    }


    /**
     * @OA\Post(
     *     path="/converter",
     *     tags={"/"},
     *     description="Lista as combinações das moedas disponíveis para compra.<br><br><strong>Regras de negócio</strong><ol><li>A moeda base para conversão será sempre BRL</li><li>O valor de origem deve ser maior que R$ 1.000,00 e menor que R$ 100.000,00</li><li>Taxas forma de pagamento: 1,45% para boleto e 7,63% cartão</li><li>Para compras abaixo de R$ 3000,00 será cobrada uma taxa de 2% sobre o valor base. Outros valores considerar a taxa 1%</li></ol>",
     *     @OA\RequestBody(ref="#components/requestBodies/bodyConverter"),
     *     @OA\Response(response="200", ref="#components/responses/sucessoConverterMoedas"),
     *     @OA\Response(response="500", ref="#components/responses/erroInternoGenerico")
     * )
     *
     * @param CambioRequest $request
     * @return void
     * @author Jannsen <jannsen.bmg@gmail.com>
     */
    public function converter(CambioRequest $request)
    {
        $cambioService   = new CambioService;
        $this->response = $cambioService->converter($request);

        if (!$this->response) {
            $this->statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
            $this->message    = $this->response?->msg ?? \config("httpMessages.indisponivel");
        }
        return new DefaultResource($this->response, $this->message, $this->statusCode);
    }
}
