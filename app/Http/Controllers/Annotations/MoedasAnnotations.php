<?php
namespace App\Http\Controllers\Annotations;

use OpenApi\Annotations AS OA;

trait MoedasAnnotations
{
    /**
     * @OA\Response(
     *    response="sucessoIndexMoedas",
     *    description="Exemplo de como as informações das moedas serão listadas",
     *    @OA\JsonContent(
     *      @OA\Property(
     *        property="data",
     *          @OA\Property(property="AFN", type="string", example="Afghani do Afeganistão"),
     *          @OA\Property(property="MGA", type="string", example="Ariary Madagascarense"),
     *      ),
     *    ),
     * ),
     *
     */
    public function index()
    {
    }

    /**
     * @OA\Parameter(
     *     name="moeda",
     *     in="path",
     *     description="moeda desejada",
     *     required=true,
     *     @OA\Schema(type="string")
     * ),
     *
     * @OA\Response(
     *    response="sucessoShowMoedas",
     *    description="Exemplo de como o detalhamento da moeda será disponibilizado",
     *    @OA\JsonContent(
     *      @OA\Property(
     *        property="data",
     *        @OA\Property(
     *          property="USDBRL",
     *            @OA\Property(property="code", type="string", example="USD"),
     *            @OA\Property(property="codein", type="string", example="BRL"),
     *            @OA\Property(property="name", type="string", example="Dólar Americano/Real Brasileiro"),
     *            @OA\Property(property="high", type="numeric", example="5.2154"),
     *            @OA\Property(property="low", type="numeric", example="5.2154"),
     *            @OA\Property(property="varBid", type="numeric", example="0.0004"),
     *            @OA\Property(property="pctChange", type="numeric", example="0.01"),
     *            @OA\Property(property="bid", type="numeric", example="5.2149"),
     *            @OA\Property(property="ask", type="numeric", example="5.2158"),
     *            @OA\Property(property="timestamp", type="numeric", example="1644874197"),
     *            @OA\Property(property="create_date", type="string", example="2022-02-14 18:29:57", format="date-time"),
     *        ),
     *      ),
     *      @OA\Property(property="message",type="string"),
     *    ),
     * ),
     *
     */
    public function show()
    {
    }

    /**
     * @OA\Response(
     *    response="sucessoCombinacoesMoedas",
     *    description="Exemplo as combinações das moedas disponíveis para compras serão listadas",
     *    @OA\JsonContent(
     *      @OA\Property(
     *        property="data",
     *          @OA\Property(property="BRL-USD", type="string", example="Real Brasileiro/Dólar Americano"),
     *          @OA\Property(property="BRL-LBP", type="string", example="Real Brasileiro/Libra Libanesa"),
     *      ),
     *      @OA\Property(property="message",type="string"),
     *    ),
     * ),
     *
     */
    public function combinacoes()
    {
    }
}