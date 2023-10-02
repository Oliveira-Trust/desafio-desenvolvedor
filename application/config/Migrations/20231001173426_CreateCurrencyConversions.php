<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateCurrencyConversions extends AbstractMigration {

    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void {
        $table = $this->table('currency_conversions');
        $table->addColumn('user_id', 'integer', [
            'signed' => false,
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('origin_currency', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('destination_currency', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('value_to_convert', 'float', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('payment_method', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('destination_currency_conversion_value', 'float', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('destination_currency_purchased_value', 'float', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('payment_tax', 'float', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('conversion_tax', 'float', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('conversion_value_without_tax', 'float', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addIndex(['user_id']);
        $table->addForeignKey('user_id', 'users', 'id');
        
        $table->create();
    }
}
