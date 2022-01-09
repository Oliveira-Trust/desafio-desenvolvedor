<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%conversao}}`.
 */
class m220109_202341_create_conversao_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%conversao}}', [
            'id' => $this->primaryKey(),
            'moedaorigem' => $this->string('30')->notNull(),
            'valororigem' => $this->decimal(24,2)->notNull(),
            'moedadestino' => $this->string('30')->notNull(),
            'cotacaoatual' => $this->decimal(24,2)->notNull(),
            'formadepagamento' => $this->string('30')->notNull(),
            'taxapagamento' => $this->decimal(24,2)->notNull(),
            'taxaconversao' => $this->decimal(24,2)->notNull(),
            'valorconversao' => $this->decimal(24,2)->notNull(),
            'datacriacao' => $this->timestamp()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%conversao}}');
    }
}
