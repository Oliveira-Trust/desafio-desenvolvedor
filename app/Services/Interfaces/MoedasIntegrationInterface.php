<?php

namespace App\Service\Interfaces;

interface MoedasIntegrationInterface
{
    /**
     * Necessário para realizar a validação do contrato da integracação
     *
     * @param object|null $classe
     * @return \App\Service\Interfaces\MoedasInterface|null
     * @author Jannsen <jannsen.bgo@gmail.com>
     */
    public function validaContratoInterface(? object $classe) : ? \App\Service\Interfaces\MoedasInterface;

    /**
     * Contrato necessário para obter a classe definida para realizar a integração com
     * a API de moedas
     *
     * @param string|null $integracao
     * @return \App\Service\Interfaces\MoedasIntegrationInterface|null
     * @author Jannsen <jannsen.bgo@gmail.com>
     */
    public function getClasseIntegracao(? string $integracao = null) : ? \App\Service\Interfaces\MoedasIntegrationInterface;

    public function all() : array;

    public function combinacoes() : array;
}