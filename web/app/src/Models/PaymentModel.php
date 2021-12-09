<?php

use Selene\Model\ModelAbstract;
use Selene\Drivers\MongoDB\MongoDriver;

class PaymentModel extends ModelAbstract
{
    /**
     * Constante que indica o nome da tabela
     */
    const TABLENAME = 'payment';

    /**
     * Retorna os tipos de pagamentos e sua taxa de custo
     *
     * @return void
     */
    public function getMethods()
    {
        return (new MongoDriver)->query(self::TABLENAME)->toArray();
    }

    /**
     * Retorna o pagamento por seu tipo
     */
    public function getPaymentByType(int $type) : array
    {
        return (new MongoDriver)
                    ->filters(['type' => $type])
                    ->options([
                        'projection' => [
                            '_id' => 0
                        ],
                    ])
                    ->query(self::TABLENAME)
                    ->toArray();
    }

    /**
     * Retorna se o tipo de pagamento requerido é valido
     */
    public function isValidPayment(int $type) : bool
    {
        return (new MongoDriver)
                    ->filters(['type' => $type])
                    ->options([
                        'projection' => [
                            '_id' => 0
                        ],
                    ])
                    ->query(self::TABLENAME)
                    ->isValid();
    }


    /**
     * Atualiza as taxas de cobraça para a conversão do valor
     */
    public function updatePaymentTaxes(array $taxes): void
    {
        try {
            foreach ($taxes as $tax) {
                if (!is_float($tax['value']) && !is_int($tax['type'])) {
                    continue;
                }

                (new MongoDriver)->update(self::TABLENAME, ['type' => $tax['type']], ['tax' => $tax['value']]);
            }
        } catch (\Throwable $th) {
            log_error($th);
            throw $th;
        }
    }
}
