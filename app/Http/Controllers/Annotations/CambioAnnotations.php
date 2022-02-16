<?php
namespace App\Http\Controllers\Annotations;

use OpenApi\Annotations AS OA;

trait CambioAnnotations
{
    /**
     * @OA\RequestBody(
     *    request="bodyConverter",
     *    required=true,
     *    @OA\JsonContent(
     *      required={ "cambio" },
     *      @OA\Property(
     *        property="cambio",
     *        type="array",
     *        @OA\Items(
     *          @OA\Property(property="moeda", type="string", example="USD"),
     *          @OA\Property(property="valor", type="numeric", example="5000"),
     *          @OA\Property(property="forma_pagamento", type="string", example="BOLETO"),
     *        )
     *      )
     *    )
     * ),
     *
     * @OA\Response(
     *    response="sucessoConverterMoedas",
     *    description="Exemplo de como o detalhamento da moeda será disponibilizado",
     *    @OA\JsonContent(
     *      @OA\Property(
     *        property="data",
     *        @OA\Property(
     *          property="USDBRL",
     *          type="array",
     *          @OA\Items(
     *            @OA\Property(property="moeda_origem", type="string", example="BRL"),
     *            @OA\Property(property="moeda_destino", type="string", example="USD"),
     *            @OA\Property(property="valor_solicitado", type="numeric", example="5000"),
     *            @OA\Property(property="forma_pagamento", type="string", example="BOLETO"),
     *            @OA\Property(property="cotacao_moeda_destino", type="numeric", example="5.159"),
     *            @OA\Property(property="valor_comprado", type="numeric", example="945.44"),
     *            @OA\Property(property="taxa_forma_pagamento", type="numeric", example="72.5"),
     *            @OA\Property(property="taxa_conversao", type="numeric", example="50"),
     *            @OA\Property(property="valor_base_conversao", type="numeric", example="4877.5"),
     *          ),
     *        ),
     *      ),
     *      @OA\Property(property="message",type="string"),
     *    ),
     * ),
     *
     */
    public function converter()
    {
    }
}