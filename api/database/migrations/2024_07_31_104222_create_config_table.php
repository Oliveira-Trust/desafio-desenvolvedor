<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
      DB::unprepared(
        <<<SQL
        CREATE TABLE IF NOT EXISTS `config` (
          `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
          `name` VARCHAR(255) NOT NULL,
          `value` LONGTEXT,
          PRIMARY KEY (`id`),
          INDEX `name_idx` (`name`)
        );
        SQL,
      );

      DB::insert(
        query: <<<SQL
        INSERT INTO `config` (`name`, `value`)
        VALUES ('fee_percentages', :fee_percentages);
        SQL,
        bindings: [
          'fee_percentages' => json_encode([
            'min_value_fee' => [
              'min_value' => 3000,
              'percentage' => 2,
            ],
            'payment_type_fee' => [
              'cartao' => 7.36,
              'boleto' => 1.45,
            ]
          ])
        ]
      );

      $transactional_email = '<span>Moeda de origem: <strong>{{params.origin_currency}}</strong></span><br><span>Moeda de destino: <strong>{{params.destiny_currency}}</strong></span><br><span>Valor para conversão: <strong>{{params.origin_currency}}{{params.total_value}}</strong></span><br><span>Forma de pagamento: <strong>{{params.payment_type}}</strong></span><br><span>Valor de {{params.destiny_currency}}: <strong>{{params.destiny_currency_price}}</strong></span><br><span>Valor comprado em {{params.destiny_currency}}: <strong>{{params.destiny_value}}</strong></span><br><span>Taxa de pagamento: <strong>{{params.payment_fee}}</strong></span><br><span>Taxa de conversão: <strong>{{params.exchange_fee}}</strong></span><br><span>Valor utilizado para conversão descontando as taxas: <strong>{{params.net_value}}</strong></span><br><br><span>Compra feita em {{date}} às {{time}}</span>';

      DB::insert(
        query: <<<SQL
        INSERT INTO `config` (`name`, `value`)
        VALUES ('transactional_email', :transactional_email);
        SQL,
        bindings: [
          'transactional_email' => $transactional_email,
        ]
      );

      // I used my personal email because the SMTP API is attached to it.
      DB::unprepared(
        <<<SQL
        INSERT INTO `config` (`name`, `value`)
        VALUES ('company_email_address', 'diegoleandro2002@gmail.com');
        SQL,
      );

      DB::unprepared(
        <<<SQL
        INSERT INTO `config` (`name`, `value`)
        VALUES ('company_name', 'Exchangify');
        SQL,
      );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      DB::unprepared('DROP TABLE IF EXISTS `config`;');
    }
};
