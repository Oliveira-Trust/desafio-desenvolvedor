<?php
namespace App\Integrations\Interfaces;

/**
 * @author Jannsen <jannsen.bgo@gmail.com>
 */
interface IntegracaoInterface
{
    /**
     * Definindo o contrato do corpo da requisição
     *
     * @param array $body
     * @return IntegracaoAbstractInterface
     * @author Jannsen <jannsen.bgo@gmail.com>
     */
    public function setBody(array $body) : IntegracaoAbstractInterface;

    /**
     * Definindo o contrato do cabeçalho da requisição
     *
     * @param array $headers
     * @return IntegracaoAbstractInterface
     * @author Jannsen <jannsen.bgo@gmail.com>
     */
    public function setHeaders(array $headers) : IntegracaoAbstractInterface;
}