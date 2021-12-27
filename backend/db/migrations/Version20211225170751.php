<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211225170751 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Migration to create table payment_type';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("CREATE TABLE payment_type (id INT AUTO_INCREMENT NOT NULL,
        TYPE VARCHAR(255) NOT NULL,
        conversionTax DOUBLE PRECISION NOT NULL,
        PRIMARY KEY(id)) DEFAULT CHARACTER SET
        utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB;");

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
