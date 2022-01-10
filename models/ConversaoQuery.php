<?php

namespace app\models;

/**
 * Essa é uma classe ActiveQuery para o model Conversao.
 *
 * @see Conversao
 */
class ConversaoQuery extends \yii\db\ActiveQuery
{
    /**
     * {@inheritdoc}
     * 
     * @return Conversao[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * 
     * @return Conversao|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
