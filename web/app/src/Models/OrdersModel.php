<?php

use Selene\Model\ModelAbstract;
use Selene\Drivers\MongoDB\MongoDriver;

class OrdersModel extends ModelAbstract
{
    /**
     * Constante que indica o nome da tabela
     */
    const TABLENAME = 'orders';

    /**
     * Retorna as ordens do histórico
     */
    public function findOrder(int $userId) : array
    {
        try {
            return (new MongoDriver)
                ->filters(['user_id' => $userId])
                ->query(self::TABLENAME)
                ->toArray();
        } catch (\Throwable $th) {
            log_error($th);
            throw $th;
        }
    }

    /**
     * Retorna o pagamento por seu tipo
     */
    public function saveOrder(array $order) : bool
    {
        try {
            (new MongoDriver)->insert(self::TABLENAME, $order);
            return true;
        } catch (\Throwable $th) {
            log_error($th);
            throw $th;
        }
    }
}
