<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211231142906 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Migrations to create and insert tax transactions.';
    }
    public function up(Schema $schema): void
    {
        $this->addSql("CREATE TABLE tax_transactions (id INT AUTO_INCREMENT NOT NULL,
        minimumTransactionValue DOUBLE PRECISION NOT NULL,
        maximumTransactionValue DOUBLE PRECISION NOT NULL,
        rateForlowValue DOUBLE PRECISION NOT NULL,
        lowValue DOUBLE PRECISION NOT NULL,
        rateForHighValue DOUBLE PRECISION NOT NULL,
        PRIMARY KEY(id)) DEFAULT CHARACTER SET
        utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB;");

        $this->addSql("INSERT INTO tax_transactions (
                                    minimumtransactionvalue,
                                    maximumtransactionvalue,
                                    rateforlowvalue,
                                    lowvalue,
                                    rateforhighvalue) VALUES (
                                                            1000,
                                                            1000000,
                                                            2,
                                                            3000,
                                                            1);");
        
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
