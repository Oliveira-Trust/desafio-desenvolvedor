<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211229181045 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Migration to insert payments types default.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("INSERT INTO payment_type (`TYPE`, conversionTax) VALUES('Boleto', 1.45)");
        $this->addSql("INSERT INTO payment_type (`TYPE`, conversionTax) VALUES ('Cartão de credito', 7.63)");
    }

    public function down(Schema $schema): void
    {    
    }
}
