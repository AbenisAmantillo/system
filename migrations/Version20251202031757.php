<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251202031757 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE furniture (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, status VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, property_id INT DEFAULT NULL, INDEX IDX_665DDAB3549213EC (property_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE property (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, status LONGTEXT NOT NULL, price DOUBLE PRECISION NOT NULL, address VARCHAR(255) NOT NULL, image_file_name VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE furniture ADD CONSTRAINT FK_665DDAB3549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE furniture DROP FOREIGN KEY FK_665DDAB3549213EC');
        $this->addSql('DROP TABLE furniture');
        $this->addSql('DROP TABLE property');
    }
}
