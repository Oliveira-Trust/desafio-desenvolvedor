<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211225170639 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Migration to create table currency.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("CREATE TABLE currency (id INT AUTO_INCREMENT NOT NULL,
        code VARCHAR(255) NOT NULL,
        codein VARCHAR(255) NOT NULL,
        name VARCHAR(255) NOT NULL,
        salePrice DOUBLE PRECISION NOT NULL,
        purchasePrice DOUBLE PRECISION NOT NULL,
        PRIMARY KEY(id)) DEFAULT CHARACTER SET
        utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB;");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("DROP TABLE currency");
    }
}
