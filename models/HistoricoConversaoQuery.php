<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[HistoricoConversao]].
 *
 * @see HistoricoConversao
 */
class HistoricoConversaoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return HistoricoConversao[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return HistoricoConversao|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
