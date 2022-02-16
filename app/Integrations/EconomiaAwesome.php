<?php
namespace App\Integrations;

use App\Integrations\Abstracts\IntegracaoAbstract;
use App\Integrations\Interfaces\{IntegracaoInterface, IntegracaoAbstractInterface};
use App\Service\Interfaces\MoedasInterface;
use App\Integrations\Traits\EconomiaAwesomeTrait;

class EconomiaAwesome extends IntegracaoAbstract implements IntegracaoInterface, MoedasInterface
{
    use EconomiaAwesomeTrait;

    private const BASE_URL = 'https://economia.awesomeapi.com.br';

    public function __construct()
    {
        parent::__construct(self::BASE_URL);
    }

    /**
     * Método necessário para disponibilizar todas as moedas disponíveis para integração
     *
     * @return array
     * @author Jannsen <jannsen.bgo@gmail.com>
     */
    public function all() : array
    {
        parent::setHeaders(["headers" => [ "Accept" => "application/json" ]])
              ->setMethod("GET")
              ->setEndpoint("/json/available/uniq")
              ->realizaRequisicao()
            ;
        return $this->prepare(null, parent::getResponse());
    }

    /**
     * Método necessário para disponibilizar todas as moedas disponíveis para integração
     *
     * @return array
     * @author Jannsen <jannsen.bgo@gmail.com>
     */
    public function combinacoes() : array
    {
        return \Cache::remember('combinicacoes', \Carbon\Carbon::now()->addMinutes(5), function () {
            parent::setHeaders(["headers" => [ "Accept" => "application/json" ]])
                ->setMethod("GET")
                ->setEndpoint("/json/available")
                ->realizaRequisicao()
            ;
            return $this->prepare('combinacoes', parent::getResponse());
        });
    }

    /**
     * Método responsável por disponibilizar a contação da moeda
     *
     * @param string $moeda
     * @return array
     * @author Jannsen <jannsen.bgo@gmail.com>
     */
    public function cotacaoMoeda(string $moeda) : array
    {
        parent::setHeaders(["headers" => [ "Accept" => "application/json" ]])
              ->setMethod("GET")
              ->setEndpoint("/json/last/{$moeda}")
              ->realizaRequisicao()
            ;
        return $this->prepare(null, parent::getResponse());
    }

    /**
     * Atribuindo o conteúdo da requisição que será acionada
     *
     * @param array $body
     * @return IntegracaoAbstractInterface
     * @see \App\Integrations\Interfaces\IntegracaoInterface@setBody
     * @author Jannsen <jannsen.bgo@gmail.com>
     */
    public function setBody(array $body) : IntegracaoAbstractInterface
    {
        parent::setBody($body);
        return $this;
    }

    /**
     * Atribuindo o cabeçalho da requisição que será acionada
     *
     * @param array $headers
     * @return IntegracaoAbstractInterface
     * @see \App\Integrations\Interfaces\IntegracaoInterface@setHeaders
     * @author Jannsen <jannsen.bgo@gmail.com>
     */
    public function setHeaders(array $headers) : IntegracaoAbstractInterface
    {
        parent::setHeaders($headers);
        return $this;
    }
}