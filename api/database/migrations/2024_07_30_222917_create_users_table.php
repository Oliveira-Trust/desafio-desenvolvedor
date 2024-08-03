<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        CREATE TABLE IF NOT EXISTS `users` (
          `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
          `name` VARCHAR(45) NOT NULL,
          `email` VARCHAR(90) NOT NULL,
          `password` VARCHAR(297) NOT NULL,
          `type` ENUM('admin', 'regular') DEFAULT 'regular',
          `profile_picture_url` VARCHAR(60) NULL,
          `created_at` DATETIME NOT NULL,
          `updated_at` DATETIME NOT NULL,
          PRIMARY KEY (`id`),
          INDEX `email_idx` (`email`)
        )
        SQL,
      );

      DB::insert(
        query: <<<SQL
        INSERT INTO `users` (`id`, `name`, `email`, `password`, `type`, `profile_picture_url`, `created_at`, `updated_at`)
        VALUES (NULL, 'Admin admin', :email, :password, 'admin', 'https://avatars.githubusercontent.com/u/82422126?v=4', '2024-08-02 04:08:20.000000', '2024-08-02 04:08:20.000000') 
        SQL,
        bindings: [
          'email' => 'admin@gmail.com',
          'password' => Hash::make(123456)
        ]
      );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      DB::unprepared('DROP TABLE IF EXISTS `users`;');
    }
};
