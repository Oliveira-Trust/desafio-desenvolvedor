<?php

use Selene\Model\ModelAbstract;
use Selene\Drivers\MongoDB\MongoDriver;

class CurrencyCodesModel extends ModelAbstract
{
    /**
     * Constante que indica o nome da tabela
     */
    const TABLENAME = 'currency_codes';

    /**
     * Retorna os códigos de conversão disponíveis
     */
    public function getCodes(): array
    {
        return (new MongoDriver)->query(self::TABLENAME)->toArray();
    }

    /**
     * Verifica se um código de conversão é válido
     */
    public function isValidCode(string $code) : bool
    {
        return (new MongoDriver)
                ->filters(['type' => $code])
                ->options([
                    'projection' => [
                        '_id' => 0
                    ],
                ])
                ->query(self::TABLENAME)
                ->isValid();
    }
}
