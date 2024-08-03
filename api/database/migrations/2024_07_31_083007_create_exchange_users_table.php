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
        CREATE TABLE IF NOT EXISTS `exchange_users` (
          `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
          `user_id` SMALLINT UNSIGNED NOT NULL,
          `created_at` DATETIME NOT NULL,
          `exchange_data` JSON NOT NULL,
          PRIMARY KEY (`id`),
          INDEX `user_id_idx` (`user_id`),
          CONSTRAINT `fk_user_id`
            FOREIGN KEY (`user_id`)
            REFERENCES `users` (`id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION
        );
        SQL,
      );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      DB::unprepared('DROP TABLE IF EXISTS `exchange_users`;');
    }
};
