<?php

use Selene\Model\ModelAbstract;

class ConvertModel extends ModelAbstract
{
    /**
     * Constante que indica o nome da tabela
     */
    const TABLENAME = '';

    /**
     * (deve ser maior que R$ 1.000,00 e menor que R$ 100.000,00)
     */
    const MIN_VALUE_CONSTRAINT = 1000;
    const MAX_VALUE_CONSTRAINT = 100000;

    /**
     * Retorna os tipos de pagamentos e sua taxa de custo
     */
    public function getValueConstraints() : array
    {
        return [
            'min' => self::MIN_VALUE_CONSTRAINT,
            'max' => self::MIN_VALUE_CONSTRAINT,
        ];
    }
}
