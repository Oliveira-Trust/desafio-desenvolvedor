<?php

namespace App\Service\Interfaces;

interface MoedasInterface
{
    /**
     * Contrato definido para disponibilizar todas as moedas disponíveis para integração
     *
     * @return array
     * @author Jannsen <jannsen.bgo@gmail.com>
     */
    public function all() : array;

    /**
     * Contrato definido para disponibilizar as combinações disponíveis
     *
     * @return array
     * @author Jannsen <jannsen.bgo@gmail.com>
     */
    public function combinacoes() : array;

    /**
     * Contrato definido para disponibilizar a contação da moeda
     *
     * @param string $moeda
     * @return array
     * @author Jannsen <jannsen.bgo@gmail.com>
     */
    public function cotacaoMoeda(string $moeda) : array;
}