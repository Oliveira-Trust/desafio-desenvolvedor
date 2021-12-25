<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210524130837 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('
        CREATE TABLE users (
            id INT AUTO_INCREMENT NOT NULL,
            name VARCHAR(50),
            username VARCHAR(30) UNIQUE NOT NULL,
            password VARCHAR(60) NOT NULL,
            email VARCHAR(150) NOT NULL,
            PRIMARY KEY(id)
        )ENGINE = InnoDB');
        $pass = password_hash('123456', PASSWORD_DEFAULT);
        $this->addSql("INSERT INTO users (name, username, password ) VALUES('ADMIN', 'ADMIN', '".$pass."')");
    }
    public function down(Schema $schema): void
    {
        $this->addSql("DROP TABLE users");
    }
}
