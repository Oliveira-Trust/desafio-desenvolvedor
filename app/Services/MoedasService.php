<?php

namespace App\Service;
use App\Service\Interfaces\MoedasIntegrationInterface;

class MoedasService implements MoedasIntegrationInterface
{
    private $response;
    private $class;

    public function __construct()
    {
        $this->getClasseIntegracao();
    }

    /**
     * Método responsável por disponibilizar todas as moedas
     *
     * @return array
     * @author Jannsen <jannsen.bgo@gmail.com>
     * @see MoedasIntegrationInterface@all
     */
    public function all() : array
    {
        if ($this->class)
        {
            try {
                $this->response = $this->class->all();
            } catch (\Exception $e) {
                $this->response = errorLog($e->getMessage(), 'CM0001');
            }
            finally {
                return $this->response;
            }
        }
        return errorLog("Undefined", 'CM0002');
    }

    /**
     * Método responsável por listar todas as combinações disponíveis para combra
     *
     * @return array
     * @author Jannsen <jannsen.bgo@gmail.com>
     * @see MoedasIntegrationInterface@combinacoes
     */
    public function combinacoes() : array
    {
        if ($this->class)
        {
            try {
                $this->response = $this->class->combinacoes();
            } catch (\Exception $e) {
                $this->response = errorLog($e->getMessage(), 'CM0003');
            }
            finally {
                return $this->response;
            }
        }
        return errorLog("Undefined", 'CM0004');
    }

    /**
     * Método responsável por realizar a consulta da contação da moeda
     * @param string $moeda
     * @return array
     * @author Jannsen <jannsen.bgo@gmail.com>
     * @see MoedasIntegrationInterface@cotacaoMoeda
     */
    public function cotacaoMoeda(string $moeda) : array
    {
        if ($this->class)
        {
            try {
                $this->response = $this->class->cotacaoMoeda($moeda);
            } catch (\Exception $e) {
                $this->response = errorLog($e->getMessage(), 'CM0005');
            }
            finally {
                return $this->response;
            }
        }
        return errorLog("Undefined", 'CM0006');
    }

    /**
     * Método responsável por realizar a validação do contrato da integracação
     *
     * @param object|null $classe
     * @return \App\Service\Interfaces\MoedasInterface|null
     * @author Jannsen <jannsen.bgo@gmail.com>
     * @see MoedasIntegrationInterface@svalidaContratoInterface
     */
    public function validaContratoInterface(? object $classe) : ? \App\Service\Interfaces\MoedasInterface
    {
        return $classe instanceof \App\Service\Interfaces\MoedasInterface ? $classe : null;
    }

    /**
     * Método responsável por obter a classe definida para realizar a integração com
     * a API de moedas
     *
     * @param string|null $integracao
     * @return \App\Service\Interfaces\MoedasIntegrationInterface|null
     * @author Jannsen <jannsen.bgo@gmail.com>
     * @see MoedasIntegrationInterface@getClasseIntegracao
     */
    public function getClasseIntegracao(? string $integracao = null) : ? \App\Service\Interfaces\MoedasIntegrationInterface
    {
        $classeIntegracao = !empty($integracao) && \array_key_exists($integracao, \config("integracaoMoedas.tipo_integracao")) ? \config("integracaoMoedas.tipo_integracao.{$integracao}") : \config("integracaoMoedas.tipo_integracao.default");
        if ($classeIntegracao && \class_exists($classeIntegracao)) {
            $this->class = $this->validaContratoInterface(new $classeIntegracao);
        }
        return $this;
    }
}