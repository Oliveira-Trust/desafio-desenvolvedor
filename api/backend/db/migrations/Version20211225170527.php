<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211225170527 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Migration to create table users.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL,
        name VARCHAR(255) NOT NULL,
        username VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        PRIMARY KEY(id)) DEFAULT CHARACTER SET
        utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB;");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("DROP TABLE users");

    }
}
