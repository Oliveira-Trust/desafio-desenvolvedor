<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%historico_conversao}}`.
 */
class m220106_010832_create_historico_conversao_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%historico_conversao}}', [
            'id' => $this->primaryKey(),
            'moedaorigem' => $this->string('30'),
            'valororigem' => $this->decimal(24,8),
            'moedadestino' => $this->string('30'),
            'valordestino' => $this->decimal(24,8),
            'formadepagamento' => $this->string('30'),
            'cotacao' => $this->decimal(24,8),
            'taxapagamento' => $this->decimal(24,8),
            'taxaconversao' => $this->decimal(24,8),
            'valorfinal' => $this->decimal(24,8),
            'datacriacao' => $this->timestamp()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%historico_conversao}}');
    }
}
