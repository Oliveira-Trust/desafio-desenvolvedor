<?php

namespace App\Http\Controllers;

use App\Http\Resources\DefaultResource;
use \App\Service\MoedasService;
use \Illuminate\Http\Response;

class MoedasController extends Controller
{
    private $response;
    private $message;
    private $statusCode;

    public function __construct()
    {
        $this->message    = "";
    }

    /**
     * @OA\Get(
     *     path="/moedas",
     *     tags={"moedas"},
     *     description="Lista de moedas disponíveis para conversão",
     *     @OA\Response(response="200", ref="#components/responses/sucessoIndexMoedas"),
     *     @OA\Response(response="500", ref="#components/responses/erroInternoGenerico")
     * )
     *
     * @return  \Illuminate\Http\Response
     * @author Jannsen <jannsen.bmg@gmail.com>
     */
    public function index()
    {
        $moedaService   = new MoedasService();
        $this->response = $moedaService->all();

        if (!$this->response) {
            $this->statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
            $this->message    = $this->response?->msg ?? \config("httpMessages.indisponivel");
        }
        return new DefaultResource($this->response, $this->message, $this->statusCode);
    }

    /**
     * @OA\Get(
     *     path="/moedas/{MOEDA}",
     *     tags={"moedas"},
     *     @OA\Parameter(ref="#components/parameters/moeda"),
     *     description="Diposnibiliza o detalhamento sobre a moeda desejada",
     *     @OA\Response(response="200", ref="#components/responses/sucessoShowMoedas"),
     *     @OA\Response(response="500", ref="#components/responses/erroInternoGenerico"),
     *     @OA\Response(response="406", ref="#components/responses/modeloNaoEncontrato")
     * )
     *
     * @return  \Illuminate\Http\Response
     * @author Jannsen <jannsen.bmg@gmail.com>
     */
    public function show($moeda)
    {
        $moedaService   = new MoedasService();
        $this->response = $moedaService->cotacaoMoeda($moeda);

        if (!$this->response) {
            $this->statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
            $this->message    = $this->response?->msg ?? \config("httpMessages.indisponivel");
        }
        return new DefaultResource($this->response, $this->message, $this->statusCode);
    }

    /**
     * @OA\Get(
     *     path="/moedas/combinacoes",
     *     tags={"moedas"},
     *     description="Lista as combinações das moedas disponíveis para compra",
     *     @OA\Response(response="200", ref="#components/responses/sucessoCombinacoesMoedas"),
     *     @OA\Response(response="500", ref="#components/responses/erroInternoGenerico")
     * )
     *
     * @return  \Illuminate\Http\Response
     * @author Jannsen <jannsen.bmg@gmail.com>
     */
    public function combinacoes()
    {
        $moedaService   = new MoedasService();
        $this->response = $moedaService->combinacoes();

        if (!$this->response) {
            $this->statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
            $this->message    = $this->response?->msg ?? \config("httpMessages.indisponivel");
        }
        return new DefaultResource($this->response, $this->message, $this->statusCode);
    }
}
