<?php
namespace App\Http\Controllers\Annotations;

use \OpenApi\Annotations AS OA;

/**
 * @OA\Info(title="Conversor Moedas", version="1.0.0")
 * @OA\Server(
 *     url="http://apiconversormoeda.local:81/api",
 * ),
 * @OA\Server(
 *     url="https://localhost:8000/api",
 * ),
 *
 * @OA\Response(
 *     response="modeloNaoEncontrato",
 *     description="Resposta obtida quando a instrução está correta porém não poderá ser processada",
 *     @OA\JsonContent(
 *         @OA\Property(property="message", type="string", example="Não foi possível realizar o processamento da instrução informada."),
 *     )
 * )
 *
 * @OA\Response(
 *     response="erroInternoGenerico",
 *     description="Erro interno.",
 *     @OA\JsonContent(
 *         @OA\Property(property="message", type="string", example="Serviço indisponível no momento. Tente novamente mais tarde!"),
 *     ),
 * )
 */
trait DefaultAnnotations
{

}