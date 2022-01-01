<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211225171652 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Migration to create table transactions.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("CREATE TABLE transactions (id INT AUTO_INCREMENT NOT NULL,
        user_id INT DEFAULT NULL,
        status VARCHAR(255) NOT NULL,
        value DOUBLE PRECISION NOT NULL,
        createdat DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
        dataToConvert_id INT DEFAULT NULL,
        paymentType_id INT DEFAULT NULL,
        INDEX IDX_EAA81A4C3C018BB7 (dataToConvert_id),
        INDEX IDX_EAA81A4CD6FAC91A (paymentType_id),
        INDEX IDX_EAA81A4CA76ED395 (user_id),
        PRIMARY KEY(id)) DEFAULT CHARACTER SET
        utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB;"
        );
        $this->addSql("ALTER TABLE transactions ADD CONSTRAINT FK_EAA81A4C3C018BB7 FOREIGN KEY (dataToConvert_id) REFERENCES currency (id);");
        $this->addSql("ALTER TABLE transactions ADD CONSTRAINT FK_EAA81A4CD6FAC91A FOREIGN KEY (paymentType_id) REFERENCES payment_type (id);");
        $this->addSql("ALTER TABLE transactions ADD CONSTRAINT FK_EAA81A4CA76ED395 FOREIGN KEY (user_id) REFERENCES users (id);");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("ALTER TABLE transactions DROP CONSTRAINT FK_EAA81A4C3C018BB7;");
        $this->addSql("ALTER TABLE transactions DROP CONSTRAINT FK_EAA81A4CD6FAC91A;");
        $this->addSql("ALTER TABLE transactions DROP CONSTRAINT FK_EAA81A4CA76ED395;");
        $this->addSql("DROP TABLE transations");

    }
}
